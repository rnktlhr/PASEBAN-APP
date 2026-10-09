<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pembinaan extends Model
{
    protected $table = 'pembinaan';

    protected $fillable = [
        'judul',
        'tanggal',
        'deskripsi',
        'file_absensi',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
        ];
    }

    public function kehadiranPembinaan(): HasMany
    {
        return $this->hasMany(KehadiranPembinaan::class, 'id_pembinaan');
    }

    public function dinas(): BelongsToMany
    {
        return $this->belongsToMany(Dinas::class, 'kehadiran_pembinaan', 'id_pembinaan', 'id_dinas')
            ->using(KehadiranPembinaan::class)
            ->withPivot('id', 'hadir')
            ->withTimestamps();
    }
}
