<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Monev extends Model
{
    use HasFactory;

    protected $table = 'monev';

    public const STATUS_TEPAT_WAKTU = 'tepat_waktu';
    public const STATUS_TERLAMBAT = 'terlambat';

    protected $fillable = [
        'kegiatan_id',
        'tahun',
        'bulan_rencana_mulai',
        'bulan_rencana_selesai',
        'bulan_realisasi_mulai',
        'bulan_realisasi_selesai',
        'status',
    ];

    protected $casts = [
        'tahun' => 'integer',
        'bulan_rencana_mulai' => 'integer',
        'bulan_rencana_selesai' => 'integer',
        'bulan_realisasi_mulai' => 'integer',
        'bulan_realisasi_selesai' => 'integer',
    ];

    public function kegiatanStatistik(): BelongsTo
    {
        return $this->belongsTo(KegiatanStatistik::class, 'kegiatan_id');
    }
}
