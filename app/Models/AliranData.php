<?php

namespace App\Models;

use App\Models\Traits\BelongsToKegiatan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AliranData extends Model
{
    use HasFactory, BelongsToKegiatan;

    protected $table = 'aliran_data';

    protected $fillable = [
        'kegiatan_id',
        'nama_data',
        'tahun',
        'frekuensi',
        'sudah_tayang',
        'tanggal_tayang',
    ];

    protected $casts = [
        'tahun' => 'integer',
        'sudah_tayang' => 'boolean',
        'tanggal_tayang' => 'date',
    ];
}
