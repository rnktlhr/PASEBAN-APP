<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Romantik extends Model
{
    use HasFactory;

    protected $table = 'romantik';

    protected $fillable = [
        'kegiatan_id',
        'tahun',
        'status_dinas',
        'status_kominfo',
        'status_bps',
        'tanggal_pengajuan',
        'tanggal_persetujuan',
        'catatan',
    ];

    protected $casts = [
        'tahun' => 'integer',
        'tanggal_pengajuan' => 'date',
        'tanggal_persetujuan' => 'date',
    ];

    public function kegiatanStatistik(): BelongsTo
    {
        return $this->belongsTo(KegiatanStatistik::class, 'kegiatan_id');
    }
}
