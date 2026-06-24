<?php

namespace App\Http\Controllers;

use App\Models\KegiatanPendampingan;
use Illuminate\Http\Request;

class KegiatanPendampinganController extends Controller
{
    public function show(KegiatanPendampingan $kegiatanPendampingan)
    {
        return view('kegiatan-pendampingan.show', compact('kegiatanPendampingan'));
    }
}
