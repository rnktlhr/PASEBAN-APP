<?php

namespace App\Models;

use App\Models\Concerns\LogsActivity;
use Filament\Models\Contracts\HasName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dinas extends Model implements HasName
{
    use LogsActivity;

    protected $table = 'dinas';

    public function getFilamentName(): string
    {
        return $this->nama ?? $this->singkatan ?? 'Dinas';
    }

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
