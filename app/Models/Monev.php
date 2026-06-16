<?php

namespace App\Models;

use App\Enums\StatusMonev;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Monev extends Model
{
    use HasFactory;

    protected $table = 'monev';

    protected $fillable = [
        'kegiatan_id',
        'tahun',
        'bulan_rencana_mulai',
        'bulan_rencana_selesai',
        'bulan_realisasi_mulai',
        'bulan_realisasi_selesai',
        'status',
        'status_metadata',
        'status_romantik',
    ];

    protected $casts = [
        'tahun' => 'integer',
        'bulan_rencana_mulai' => 'integer',
        'bulan_rencana_selesai' => 'integer',
        'bulan_realisasi_mulai' => 'integer',
        'bulan_realisasi_selesai' => 'integer',
        'status' => StatusMonev::class,
    ];

    public function kegiatanStatistik(): BelongsTo
    {
        return $this->belongsTo(KegiatanStatistik::class, 'kegiatan_id');
    }
}
