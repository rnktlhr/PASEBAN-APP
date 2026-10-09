<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Romantik extends Model
{
    use SoftDeletes;

    protected $table = 'romantik';

    protected $fillable = [
        'id_kegiatan',
        'tahun',
        'status_dinas',
        'status_kominfo',
        'status_bps',
    ];

    public function kegiatanStatistik(): BelongsTo
    {
        return $this->belongsTo(KegiatanStatistik::class, 'id_kegiatan');
    }

    public function metadata(): HasOne
    {
        return $this->hasOne(Metadata::class, 'id_romantik');
    }
}
