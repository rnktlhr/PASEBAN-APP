<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramPembinaan extends Model
{
    use HasFactory;

    protected $table = 'program_pembinaan';

    protected $fillable = [
        'tahun',
        'nomor_urut',
        'nama',
        'deskripsi',
        'kuartal',
        'jadwal',
        'link',
    ];
}
