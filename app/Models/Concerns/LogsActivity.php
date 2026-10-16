<?php

namespace App\Models\Concerns;

use App\Models\ActivityLog;
use BackedEnum;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * Tambahkan trait ini ke Model untuk mencatat otomatis
 * aksi Create / Update / Delete ke tabel `activity_logs`.
 */
trait LogsActivity
{
    public static function bootLogsActivity(): void
    {
        static::created(function (Model $model) {
            ActivityLog::record(
                ActivityLog::ACTION_CREATED,
                $model,
                null,
                static::auditFilter($model, $model->getAttributes()),
                static::auditLabel($model),
            );
        });

        static::updated(function (Model $model) {
            $changes = static::auditFilter($model, $model->getChanges());

            if (empty($changes)) {
                return;
            }

            $old = [];
            foreach (array_keys($changes) as $key) {
                $old[$key] = $model->getOriginal($key);
            }

            ActivityLog::record(
                ActivityLog::ACTION_UPDATED,
                $model,
                static::auditFilter($model, $old),
                $changes,
                static::auditLabel($model),
            );
        });

        static::deleted(function (Model $model) {
            ActivityLog::record(
                ActivityLog::ACTION_DELETED,
                $model,
                static::auditFilter($model, $model->getAttributes()),
                null,
                static::auditLabel($model),
            );
        });
    }

    /**
     * Buang atribut sensitif (password, token, atribut $hidden) dan
     * normalisasi nilai agar aman disimpan sebagai JSON.
     */
    protected static function auditFilter(Model $model, array $attributes): array
    {
        $excluded = array_merge(
            config('paseban.audit.excluded_attributes', []),
            $model->getHidden(),
        );

        $result = [];
        foreach ($attributes as $key => $value) {
            if (in_array($key, $excluded, true)) {
                continue;
            }

            $result[$key] = match (true) {
                $value instanceof BackedEnum => $value->value,
                $value instanceof DateTimeInterface => $value->format('Y-m-d H:i:s'),
                is_string($value) && mb_strlen($value) > 2000 => mb_substr($value, 0, 2000).'…',
                default => $value,
            };
        }

        return $result;
    }

    /**
     * Deskripsi singkat record, mis. "Dinas #3 (Dinas Kesehatan)".
     */
    protected static function auditLabel(Model $model): string
    {
        $name = $model->getAttribute('nama')
            ?? $model->getAttribute('judul')
            ?? $model->getAttribute('key')
            ?? null;

        return class_basename($model).' #'.$model->getKey().($name ? " ({$name})" : '');
    }
}
