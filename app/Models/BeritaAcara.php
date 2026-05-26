<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeritaAcara extends Model
{
    use HasFactory;

    protected $table = 'berita_acara';

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
