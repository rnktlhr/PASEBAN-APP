<?php

namespace App\Models;

use App\Enums\JenisKegiatan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class KegiatanStatistik extends Model
{
    use HasFactory;

    protected $table = 'kegiatan_statistik';

    protected static function booted()
    {
        static::created(function ($kegiatan) {
            // Generate 3 Metadata
            foreach (['kegiatan', 'variabel', 'indikator'] as $jenis) {
                $kegiatan->metadata()->firstOrCreate([
                    'tahun' => $kegiatan->tahun,
                    'jenis' => $jenis,
                ], [
                    'status_kominfo' => 'belum_diajukan',
                    'status_bps' => 'sedang_diperiksa',
                ]);
            }
            // Generate Romantik
            $kegiatan->romantik()->firstOrCreate([
                'tahun' => $kegiatan->tahun,
            ], [
                'status_dinas' => 'belum_diajukan',
                'status_kominfo' => 'sedang_diperiksa',
                'status_bps' => 'sedang_diperiksa',
            ]);
            // Generate Monev
            $kegiatan->monev()->firstOrCreate([
                'tahun' => $kegiatan->tahun,
            ], [
                'bulan_rencana_mulai' => 1,
                'bulan_rencana_selesai' => 12,
                'status' => 'belum_mulai',
            ]);
        });
    }

    protected $fillable = [
        'dinas_id',
        'nama',
        'jenis',
        'tahun',
    ];

    protected $casts = [
        'tahun' => 'integer',
        'jenis' => JenisKegiatan::class,
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



    public function monev(): HasMany
    {
        return $this->hasMany(Monev::class, 'kegiatan_id');
    }
}
