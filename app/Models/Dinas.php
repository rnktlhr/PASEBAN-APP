<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Filament\Models\Contracts\HasName;

class Dinas extends Model implements HasName
{
    use HasFactory;

    protected $table = 'dinas';

    protected $fillable = [
        'nama',
        'singkatan',
        'slug',
        'instansi_code',
        'kategori',
    ];

    public function getFilamentName(): string
    {
        return $this->nama;
    }

    // --- Relationships ---

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function kegiatanStatistik(): HasMany
    {
        return $this->hasMany(KegiatanStatistik::class);
    }

    public function presensiPembinaan(): HasMany
    {
        return $this->hasMany(PresensiPembinaan::class);
    }
}
