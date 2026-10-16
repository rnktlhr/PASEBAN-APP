<?php

namespace App\Models;

use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class MateriPembinaan extends Model
{
    use LogsActivity;

    protected $table = 'materi_pembinaan';

    protected $fillable = [
        'judul',
        'tanggal',
        'file_path',
        'link_url',
        'ukuran_file',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
        ];
    }
}
