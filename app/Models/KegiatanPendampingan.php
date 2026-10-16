<?php

namespace App\Models;

use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class KegiatanPendampingan extends Model
{
    use LogsActivity;

    protected $table = 'kegiatan_pendampingan';

    protected $fillable = [
        'judul',
        'tanggal',
        'kategori',
        'gambar',
        'ringkasan',
        'narasi',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
        ];
    }
}
