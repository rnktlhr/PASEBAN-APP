<?php

namespace App\Models\Traits;

use App\Models\KegiatanStatistik;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Trait untuk model yang merupakan turunan/child dari KegiatanStatistik.
 *
 * Digunakan oleh: Romantik, Metadata, Monev.
 * Menghilangkan duplikasi method kegiatanStatistik() di keempat model.
 */
trait BelongsToKegiatan
{
    /**
     * Relasi BelongsTo ke KegiatanStatistik.
     */
    public function kegiatanStatistik(): BelongsTo
    {
        return $this->belongsTo(KegiatanStatistik::class, 'kegiatan_id');
    }
}
