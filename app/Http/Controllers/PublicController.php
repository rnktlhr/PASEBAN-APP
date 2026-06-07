<?php

namespace App\Http\Controllers;

use App\Models\AliranData;
use App\Models\KegiatanStatistik;
use App\Models\Metadata;
use App\Models\Monev;
use App\Models\Romantik;
use App\Models\Dinas;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function kegiatan(Request $request)
    {
        $request->validate(['tahun' => 'nullable|integer|min:2020|max:2099']);
        $tahun = (int) $request->query('tahun', date('Y'));

        $kegiatan = KegiatanStatistik::with('dinas')
            ->where('tahun', $tahun)
            ->orderBy('dinas_id')
            ->get();
            
        $dinasList = Dinas::orderBy('nama')->get();

        return view('public.kegiatan', compact('kegiatan', 'tahun', 'dinasList'));
    }

    public function romantik(Request $request)
    {
        $request->validate(['tahun' => 'nullable|integer|min:2020|max:2099']);
        $tahun = (int) $request->query('tahun', date('Y'));

        $romantik = Romantik::with('kegiatanStatistik.dinas')
            ->where('tahun', $tahun)
            ->get();
            
        $dinasList = Dinas::orderBy('nama')->get();

        return view('public.romantik', compact('romantik', 'tahun', 'dinasList'));
    }

    public function metadata(Request $request)
    {
        $request->validate(['tahun' => 'nullable|integer|min:2020|max:2099']);
        $tahun = (int) $request->query('tahun', date('Y'));

        $metadata = Metadata::with('kegiatanStatistik.dinas')
            ->where('tahun', $tahun)
            ->orderBy('kegiatan_id')
            ->orderBy('jenis')
            ->get();
            
        $dinasList = Dinas::orderBy('nama')->get();

        return view('public.metadata', compact('metadata', 'tahun', 'dinasList'));
    }

    public function aliranData(Request $request)
    {
        $request->validate(['tahun' => 'nullable|integer|min:2020|max:2099']);
        $tahun = (int) $request->query('tahun', date('Y'));

        $aliranData = AliranData::with('kegiatanStatistik.dinas')
            ->where('tahun', $tahun)
            ->get();
            
        $dinasList = Dinas::orderBy('nama')->get();

        return view('public.aliran_data', compact('aliranData', 'tahun', 'dinasList'));
    }

    public function monev(Request $request)
    {
        $request->validate(['tahun' => 'nullable|integer|min:2020|max:2099']);
        $tahun = (int) $request->query('tahun', date('Y'));

        return view('public.monev', compact('tahun'));
    }
}
