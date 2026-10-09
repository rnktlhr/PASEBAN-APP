<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class KegiatanStatistik extends Model
{
    use SoftDeletes;

    protected $table = 'kegiatan_statistik';

    protected $fillable = [
        'id_dinas',
        'nama',
        'jenis',
        'tahun',
    ];

    public function dinas(): BelongsTo
    {
        return $this->belongsTo(Dinas::class, 'id_dinas');
    }

    public function romantik(): HasOne
    {
        return $this->hasOne(Romantik::class, 'id_kegiatan');
    }

    public function monev(): HasOne
    {
        return $this->hasOne(Monev::class, 'id_kegiatan');
    }
}
