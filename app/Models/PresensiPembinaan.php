<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PresensiPembinaan extends Model
{
    use HasFactory;

    protected $table = 'presensi_pembinaan';

    protected $fillable = [
        'pembinaan_id',
        'dinas_id',
        'hadir',
    ];

    protected $casts = [
        'hadir' => 'boolean',
    ];

    public function pembinaan(): BelongsTo
    {
        return $this->belongsTo(Pembinaan::class);
    }

    public function dinas(): BelongsTo
    {
        return $this->belongsTo(Dinas::class);
    }
}
