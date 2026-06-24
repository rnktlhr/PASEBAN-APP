<?php

namespace App\Models;

use App\Models\Traits\BelongsToKegiatan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Romantik extends Model
{
    use HasFactory, BelongsToKegiatan;

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
}
