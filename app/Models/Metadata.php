<?php

namespace App\Models;

use App\Models\Traits\BelongsToKegiatan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metadata extends Model
{
    use HasFactory, BelongsToKegiatan;

    protected $table = 'metadata';

    protected $fillable = [
        'kegiatan_id',
        'jenis',
        'tahun',
        'status_dinas',
        'status_kominfo',
        'status_bps',
        'catatan',
    ];

    protected $casts = [
        'tahun' => 'integer',
    ];
}
