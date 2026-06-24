<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanPendampingan extends Model
{
    use HasFactory;

    protected $table = 'kegiatan_pendampingan';

    protected $fillable = [
        'judul',
        'tanggal',
        'kategori',
        'gambar',
        'ringkasan',
        'narasi',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];
}
