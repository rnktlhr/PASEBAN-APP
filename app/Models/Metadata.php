<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Metadata extends Model
{
    use HasFactory;

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

    public function kegiatanStatistik(): BelongsTo
    {
        return $this->belongsTo(KegiatanStatistik::class, 'kegiatan_id');
    }
}
