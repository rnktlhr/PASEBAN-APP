<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriPembinaan extends Model
{
    use HasFactory;

    protected $table = 'materi_pembinaan';

    protected $fillable = [
        'judul',
        'jenis',
        'tanggal',
        'file_path',
        'link_url',
        'ukuran_file',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];
}
