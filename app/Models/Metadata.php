<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Metadata extends Model
{
    use SoftDeletes;

    protected $table = 'metadata';

    protected $fillable = [
        'id_romantik',
        'jenis',
        'tahun',
        'status_dinas',
        'status_kominfo',
        'status_bps',
    ];

    public function romantik(): BelongsTo
    {
        return $this->belongsTo(Romantik::class, 'id_romantik');
    }
}
