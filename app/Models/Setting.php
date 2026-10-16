<?php

namespace App\Models;

use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Pengaturan dinamis aplikasi (key-value) yang dikelola Admin.
 *
 * Nilai dibaca melalui helper `setting('key')`. Seluruh pengaturan di-cache
 * selamanya dan otomatis dibersihkan setiap kali ada perubahan data.
 */
class Setting extends Model
{
    use LogsActivity;

    protected $table = 'settings';

    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'description',
    ];

    protected static function booted(): void
    {
        static::saved(fn () => static::flushCache());
        static::deleted(fn () => static::flushCache());
    }

    /**
     * Ambil nilai pengaturan berdasarkan key.
     * Urutan prioritas: database -> default di config/paseban.php -> $default.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        $values = static::allValues();

        if (array_key_exists($key, $values) && $values[$key] !== null && $values[$key] !== '') {
            return $values[$key];
        }

        return config("paseban.settings.{$key}.0", $default);
    }

    /**
     * Simpan (atau perbarui) nilai pengaturan.
     */
    public static function set(string $key, mixed $value): void
    {
        $definition = config("paseban.settings.{$key}", [null, 'string', 'umum', null]);

        $setting = static::firstOrNew(['key' => $key]);
        $setting->fill([
            'value' => $value,
            'type' => $setting->type ?? $definition[1],
            'group' => $setting->group ?? $definition[2],
            'description' => $setting->description ?? $definition[3],
        ]);

        // Simpan hanya jika ada perubahan agar tidak membuat log audit kosong.
        if (! $setting->exists || $setting->isDirty()) {
            $setting->save();
        }
    }

    /**
     * Seluruh pengaturan dalam bentuk [key => value], di-cache selamanya.
     */
    public static function allValues(): array
    {
        try {
            return Cache::rememberForever(static::cacheKey(), function () {
                return static::query()->pluck('value', 'key')->all();
            });
        } catch (Throwable $e) {
            // Tabel belum dimigrasi atau database tidak tersedia: gunakan default config.
            Log::warning('Gagal memuat pengaturan aplikasi: '.$e->getMessage());

            return [];
        }
    }

    public static function flushCache(): void
    {
        Cache::forget(static::cacheKey());
    }

    protected static function cacheKey(): string
    {
        return config('paseban.settings_cache_key', 'app_settings');
    }
}
