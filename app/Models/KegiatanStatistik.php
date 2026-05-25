<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class KegiatanStatistik extends Model
{
    use HasFactory;

    protected $table = 'kegiatan_statistik';

    protected $fillable = [
        'dinas_id',
        'nama',
        'jenis',
        'tahun',
    ];

    protected $casts = [
        'tahun' => 'integer',
    ];

    public function dinas(): BelongsTo
    {
        return $this->belongsTo(Dinas::class);
    }

    public function romantik(): HasOne
    {
        return $this->hasOne(Romantik::class, 'kegiatan_id');
    }

    public function metadata(): HasMany
    {
        return $this->hasMany(Metadata::class, 'kegiatan_id');
    }

    public function aliranData(): HasMany
    {
        return $this->hasMany(AliranData::class, 'kegiatan_id');
    }

    public function monev(): HasMany
    {
        return $this->hasMany(Monev::class, 'kegiatan_id');
    }
}
