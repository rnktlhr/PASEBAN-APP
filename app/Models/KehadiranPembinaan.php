<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Pivot N:M dinas <-> pembinaan. Bisa dipakai lewat relasi belongsToMany
 * maupun di-query langsung (mis. untuk rekap / import kehadiran dari Excel).
 */
class KehadiranPembinaan extends Pivot
{
    protected $table = 'kehadiran_pembinaan';

    public $incrementing = true;

    protected $fillable = [
        'id_pembinaan',
        'id_dinas',
        'hadir',
    ];

    protected function casts(): array
    {
        return [
            'hadir' => 'boolean',
        ];
    }

    public function pembinaan(): BelongsTo
    {
        return $this->belongsTo(Pembinaan::class, 'id_pembinaan');
    }

    public function dinas(): BelongsTo
    {
        return $this->belongsTo(Dinas::class, 'id_dinas');
    }
}
