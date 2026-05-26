<?php

namespace App\Http\Controllers;

use App\Models\BeritaAcara;
use Illuminate\Http\Request;

class BeritaAcaraController extends Controller
{
    public function show(BeritaAcara $beritaAcara)
    {
        return view('berita-acara.show', compact('beritaAcara'));
    }
}
