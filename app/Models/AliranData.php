<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AliranData extends Model
{
    use HasFactory;

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

    public function kegiatanStatistik(): BelongsTo
    {
        return $this->belongsTo(KegiatanStatistik::class, 'kegiatan_id');
    }
}
