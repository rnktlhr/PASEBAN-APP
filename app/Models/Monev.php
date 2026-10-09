<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Monev extends Model
{
    protected $table = 'monev';

    protected $fillable = [
        'id_kegiatan',
        'tahun',
        'bulan',
        'status',
    ];

    public function kegiatanStatistik(): BelongsTo
    {
        return $this->belongsTo(KegiatanStatistik::class, 'id_kegiatan');
    }
}
