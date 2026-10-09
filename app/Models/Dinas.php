<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dinas extends Model
{
    protected $table = 'dinas';

    protected $fillable = [
        'nama',
        'singkatan',
        'slug',
        'instansi_code',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'id_dinas');
    }

    public function kegiatanStatistik(): HasMany
    {
        return $this->hasMany(KegiatanStatistik::class, 'id_dinas');
    }

    public function kehadiranPembinaan(): HasMany
    {
        return $this->hasMany(KehadiranPembinaan::class, 'id_dinas');
    }

    public function pembinaan(): BelongsToMany
    {
        return $this->belongsToMany(Pembinaan::class, 'kehadiran_pembinaan', 'id_dinas', 'id_pembinaan')
            ->using(KehadiranPembinaan::class)
            ->withPivot('id', 'hadir')
            ->withTimestamps();
    }
}
