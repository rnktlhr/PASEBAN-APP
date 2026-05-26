<?php

namespace App\Http\Controllers;

use App\Models\AliranData;
use App\Models\KegiatanStatistik;
use App\Models\Metadata;
use App\Models\Monev;
use App\Models\Romantik;
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

        return view('public.kegiatan', compact('kegiatan', 'tahun'));
    }

    public function romantik(Request $request)
    {
        $request->validate(['tahun' => 'nullable|integer|min:2020|max:2099']);
        $tahun = (int) $request->query('tahun', date('Y'));

        $romantik = Romantik::with('kegiatanStatistik.dinas')
            ->where('tahun', $tahun)
            ->get();

        return view('public.romantik', compact('romantik', 'tahun'));
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

        return view('public.metadata', compact('metadata', 'tahun'));
    }

    public function aliranData(Request $request)
    {
        $request->validate(['tahun' => 'nullable|integer|min:2020|max:2099']);
        $tahun = (int) $request->query('tahun', date('Y'));

        $aliranData = AliranData::with('kegiatanStatistik.dinas')
            ->where('tahun', $tahun)
            ->get();

        return view('public.aliran_data', compact('aliranData', 'tahun'));
    }

    public function monev(Request $request)
    {
        $request->validate(['tahun' => 'nullable|integer|min:2020|max:2099']);
        $tahun = (int) $request->query('tahun', date('Y'));

        return view('public.monev', compact('tahun'));
    }
}
