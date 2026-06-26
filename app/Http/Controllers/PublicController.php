<?php

namespace App\Http\Controllers;

use App\Models\KegiatanStatistik;
use App\Models\Metadata;
use App\Models\Monev;
use App\Models\Romantik;
use App\Models\Dinas;
use App\Models\Pembinaan;
use App\Models\MateriPembinaan;
use App\Models\KegiatanPendampingan;
use App\Services\PublicDataService;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function kegiatan(Request $request)
    {
        $request->validate(['tahun' => 'nullable|integer|min:2020|max:2099']);
        $tahun = (int) $request->query('tahun', KegiatanStatistik::max('tahun') ?? date('Y'));

        $query = KegiatanStatistik::with('dinas')->where('tahun', $tahun);
        
        if ($request->filled('dinasFilter')) {
            $query->where('dinas_id', $request->dinasFilter);
        }
        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }
        if ($request->filled('search')) {
            $search = str_replace(['%', '_'], ['\\%', '\\_'], $request->search);
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhereHas('dinas', function($q2) use ($search) {
                      $q2->where('nama', 'like', "%{$search}%")->orWhere('singkatan', 'like', "%{$search}%");
                  });
            });
        }

        $kegiatan = $query->orderBy('dinas_id')->paginate(10)->withQueryString();
        $dinasList = Dinas::orderBy('nama')->get();

        return view('public.kegiatan', compact('kegiatan', 'tahun', 'dinasList'));
    }

    public function romantik(Request $request, PublicDataService $service)
    {
        $request->validate(['tahun' => 'nullable|integer|min:2020|max:2099']);
        $tahun = (int) $request->query('tahun', KegiatanStatistik::max('tahun') ?? date('Y'));

        $query = Romantik::with('kegiatanStatistik.dinas')->where('tahun', $tahun);

        if ($request->filled('dinasFilter')) {
            $query->whereHas('kegiatanStatistik', function($q) use ($request) {
                $q->where('dinas_id', $request->dinasFilter);
            });
        }
        if ($request->filled('status')) {
            if ($request->status === 'done') {
                $query->whereIn('status_dinas', \App\Enums\StatusDinas::submittedValues());
            } else {
                $query->whereNotIn('status_dinas', \App\Enums\StatusDinas::submittedValues());
            }
        }
        if ($request->filled('search')) {
            $search = str_replace(['%', '_'], ['\\%', '\\_'], $request->search);
            $query->whereHas('kegiatanStatistik', function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhereHas('dinas', function($q2) use ($search) {
                      $q2->where('nama', 'like', "%{$search}%")->orWhere('singkatan', 'like', "%{$search}%");
                  });
            });
        }

        $romantik = $query->paginate(10)->withQueryString();
        $dinasList = Dinas::orderBy('nama')->get();

        $summary = $service->getRomantikSummary($tahun);

        return view('public.romantik', array_merge(
            compact('romantik', 'tahun', 'dinasList'),
            $summary
        ));
    }

    public function metadata(Request $request, PublicDataService $service)
    {
        $request->validate(['tahun' => 'nullable|integer|min:2020|max:2099']);
        $tahun = (int) $request->query('tahun', KegiatanStatistik::max('tahun') ?? date('Y'));

        $query = Metadata::with('kegiatanStatistik.dinas')->where('tahun', $tahun);

        if ($request->filled('dinasFilter')) {
            $query->whereHas('kegiatanStatistik', function($q) use ($request) {
                $q->where('dinas_id', $request->dinasFilter);
            });
        }
        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }
        if ($request->filled('search')) {
            $search = str_replace(['%', '_'], ['\\%', '\\_'], $request->search);
            $query->whereHas('kegiatanStatistik', function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhereHas('dinas', function($q2) use ($search) {
                      $q2->where('nama', 'like', "%{$search}%")->orWhere('singkatan', 'like', "%{$search}%");
                  });
            });
        }

        $metadata = $query->orderBy('kegiatan_id')->orderBy('jenis')->paginate(10)->withQueryString();
        $dinasList = Dinas::orderBy('nama')->get();

        $summary = $service->getMetadataSummary($tahun);

        return view('public.metadata', array_merge(
            compact('metadata', 'tahun', 'dinasList'),
            $summary
        ));
    }

    public function aliranData(Request $request, PublicDataService $service)
    {
        $request->validate(['tahun' => 'nullable|integer|min:2020|max:2099']);
        $tahun = (int) $request->query('tahun', KegiatanStatistik::max('tahun') ?? date('Y'));

        $summary = $service->getAliranDataSummary($tahun);

        return view('public.aliran_data', array_merge(
            compact('tahun'),
            $summary
        ));
    }

    public function monev(Request $request)
    {
        $request->validate(['tahun' => 'nullable|integer|min:2020|max:2099']);
        $tahun = (int) $request->query('tahun', date('Y'));

        return view('public.monev', compact('tahun'));
    }

    public function pembinaan(Request $request, PublicDataService $service)
    {
        $request->validate(['tahun' => 'nullable|integer|min:2020|max:2099']);
        $tahun = (int) $request->query('tahun', date('Y'));

        // FIX N+1 Query: Tambahkan with('presensi')
        $sesiPembinaan = Pembinaan::with('presensi')->whereYear('tanggal', $tahun)
            ->orderBy('tanggal')
            ->get();

        $materiPembinaan = MateriPembinaan::orderByDesc('tanggal')
            ->get();

        $latestKegiatanPendampingan = KegiatanPendampingan::orderByDesc('tanggal')
            ->take(3)
            ->get();

        $dinasList = Dinas::orderBy('nama')->get();

        $rekap = $service->getPembinaanRekap($sesiPembinaan, $dinasList);

        return view('public.pembinaan', array_merge(
            compact('tahun', 'sesiPembinaan', 'materiPembinaan', 'dinasList', 'latestKegiatanPendampingan'),
            $rekap
        ));
    }
}
