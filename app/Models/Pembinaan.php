<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pembinaan extends Model
{
    use HasFactory;

    protected $table = 'pembinaan';

    protected $fillable = [
        'judul',
        'tanggal',
        'deskripsi',
        'file_absensi',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function presensi(): HasMany
    {
        return $this->hasMany(PresensiPembinaan::class);
    }
}
