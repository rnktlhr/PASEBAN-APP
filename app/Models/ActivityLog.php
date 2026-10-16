<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\MassPrunable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
use Throwable;

/**
 * Jejak audit (audit trail) aktivitas pengguna.
 */
class ActivityLog extends Model
{
    use MassPrunable;

    public const ACTION_CREATED = 'created';
    public const ACTION_UPDATED = 'updated';
    public const ACTION_DELETED = 'deleted';
    public const ACTION_LOGIN = 'login';
    public const ACTION_LOGOUT = 'logout';
    public const ACTION_LOGIN_FAILED = 'login_failed';

    protected $table = 'activity_logs';

    /**
     * Log hanya ditulis oleh sistem (lihat ActivityLog::record()),
     * tidak pernah dari input form pengguna.
     */
    protected $fillable = [
        'user_id',
        'action',
        'subject_type',
        'subject_id',
        'description',
        'old_values',
        'new_values',
        'ip_address',
        'user_agent',
    ];

    protected function casts(): array
    {
        return [
            'old_values' => 'array',
            'new_values' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function subject(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Label aksi dalam Bahasa Indonesia (dari lang/id/messages.php).
     */
    public static function actionOptions(): array
    {
        return collect([
            self::ACTION_CREATED,
            self::ACTION_UPDATED,
            self::ACTION_DELETED,
            self::ACTION_LOGIN,
            self::ACTION_LOGOUT,
            self::ACTION_LOGIN_FAILED,
        ])->mapWithKeys(fn ($a) => [$a => __("messages.audit.actions.{$a}")])->all();
    }

    public static function actionColor(?string $action): string
    {
        return match ($action) {
            self::ACTION_CREATED, self::ACTION_LOGIN => 'success',
            self::ACTION_UPDATED => 'warning',
            self::ACTION_DELETED, self::ACTION_LOGIN_FAILED => 'danger',
            default => 'gray',
        };
    }

    /**
     * Catat satu aktivitas. Kegagalan pencatatan tidak boleh
     * menggagalkan proses bisnis utama.
     */
    public static function record(
        string $action,
        ?Model $subject = null,
        ?array $old = null,
        ?array $new = null,
        ?string $description = null,
        ?int $userId = null,
    ): void {
        try {
            static::create([
                'user_id' => $userId ?? Auth::id(),
                'action' => $action,
                'subject_type' => $subject ? $subject->getMorphClass() : null,
                'subject_id' => $subject?->getKey(),
                'description' => $description ? Str::limit($description, 250) : null,
                'old_values' => $old ?: null,
                'new_values' => $new ?: null,
                'ip_address' => Request::ip(),
                'user_agent' => Str::limit((string) Request::userAgent(), 500, ''),
            ]);
        } catch (Throwable $e) {
            Log::warning('Gagal mencatat activity log: '.$e->getMessage());
        }
    }

    /**
     * Hapus otomatis log yang melewati masa simpan (php artisan model:prune).
     *
     * @return Builder
     */
    public function prunable()
    {
        return static::query()->where('created_at', '<', now()->subDays(config('paseban.audit.retention_days', 365)));
    }
}
