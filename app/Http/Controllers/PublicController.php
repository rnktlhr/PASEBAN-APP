<?php

namespace App\Http\Controllers;

use App\Models\AliranData;
use App\Models\KegiatanStatistik;
use App\Models\Metadata;
use App\Models\Monev;
use App\Models\Romantik;
use App\Models\Dinas;
use App\Models\Pembinaan;
use App\Models\MateriPembinaan;
use App\Models\KegiatanPendampingan;
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

    public function romantik(Request $request)
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

        // Summary Calculations
        $totalKegiatan = KegiatanStatistik::where('tahun', $tahun)->count();
        
        $submittedValues = \App\Enums\StatusDinas::submittedValues();
        
        $disetujui = Romantik::where('tahun', $tahun)->whereIn('status_dinas', $submittedValues)->where('status_bps', \App\Enums\StatusBps::DISETUJUI->value)->count();
        $diperiksa = Romantik::where('tahun', $tahun)->whereIn('status_dinas', $submittedValues)->where('status_bps', \App\Enums\StatusBps::SEDANG_DIPERIKSA->value)->count();
        $perbaikan = Romantik::where('tahun', $tahun)->whereIn('status_dinas', $submittedValues)->where('status_bps', \App\Enums\StatusBps::PERLU_PERBAIKAN->value)->count();
        
        $dalamProses = $diperiksa + $perbaikan;
        $diajukan = Romantik::where('tahun', $tahun)->whereIn('status_dinas', $submittedValues)->count();
        $belumDiajukan = max(0, $totalKegiatan - $diajukan);

        $pctDisetujui = $totalKegiatan > 0 ? round(($disetujui / $totalKegiatan) * 100) : 0;
        $pctDiperiksa = $totalKegiatan > 0 ? round(($diperiksa / $totalKegiatan) * 100) : 0;
        $pctPerbaikan = $totalKegiatan > 0 ? round(($perbaikan / $totalKegiatan) * 100) : 0;
        $pctDalamProses = $totalKegiatan > 0 ? round(($dalamProses / $totalKegiatan) * 100) : 0;
        $pctBelum = $totalKegiatan > 0 ? round(($belumDiajukan / $totalKegiatan) * 100) : 0;
        $pctDiajukan = $totalKegiatan > 0 ? round(($diajukan / $totalKegiatan) * 100) : 0;

        return view('public.romantik', compact(
            'romantik', 'tahun', 'dinasList',
            'totalKegiatan', 'disetujui', 'diperiksa', 'perbaikan', 'dalamProses', 'diajukan', 'belumDiajukan',
            'pctDisetujui', 'pctDiperiksa', 'pctPerbaikan', 'pctDalamProses', 'pctBelum', 'pctDiajukan'
        ));
    }

    public function metadata(Request $request)
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

        // Summary Calculations
        $totalKegiatan = KegiatanStatistik::where('tahun', $tahun)->count();

        // Kegiatan
        $metaKegiatanDone = Metadata::where('tahun', $tahun)->where('jenis', 'kegiatan')
            ->whereIn('status_kominfo', \App\Enums\StatusKominfo::completedValues())->count();
        $metaKegiatanDraft = Metadata::where('tahun', $tahun)->where('jenis', 'kegiatan')
            ->where('status_kominfo', \App\Enums\StatusKominfo::DRAFT->value)->count();
        $metaKegiatanBelum = max(0, $totalKegiatan - $metaKegiatanDone - $metaKegiatanDraft);

        // Variabel
        $metaVariabelDone = Metadata::where('tahun', $tahun)->where('jenis', 'variabel')
            ->whereIn('status_kominfo', \App\Enums\StatusKominfo::completedValues())->count();
        $metaVariabelDraft = Metadata::where('tahun', $tahun)->where('jenis', 'variabel')
            ->where('status_kominfo', \App\Enums\StatusKominfo::DRAFT->value)->count();
        $metaVariabelBelum = max(0, $totalKegiatan - $metaVariabelDone - $metaVariabelDraft);

        // Indikator
        $metaIndikatorDone = Metadata::where('tahun', $tahun)->where('jenis', 'indikator')
            ->whereIn('status_kominfo', \App\Enums\StatusKominfo::completedValues())->count();
        $metaIndikatorDraft = Metadata::where('tahun', $tahun)->where('jenis', 'indikator')
            ->where('status_kominfo', \App\Enums\StatusKominfo::DRAFT->value)->count();
        $metaIndikatorBelum = max(0, $totalKegiatan - $metaIndikatorDone - $metaIndikatorDraft);

        $pctKegiatan = $totalKegiatan > 0 ? round(($metaKegiatanDone / $totalKegiatan) * 100) : 0;
        $pctVariabel = $totalKegiatan > 0 ? round(($metaVariabelDone / $totalKegiatan) * 100) : 0;
        $pctIndikator = $totalKegiatan > 0 ? round(($metaIndikatorDone / $totalKegiatan) * 100) : 0;

        return view('public.metadata', compact(
            'metadata', 'tahun', 'dinasList', 
            'totalKegiatan', 
            'metaKegiatanDone', 'metaKegiatanDraft', 'metaKegiatanBelum',
            'metaVariabelDone', 'metaVariabelDraft', 'metaVariabelBelum',
            'metaIndikatorDone', 'metaIndikatorDraft', 'metaIndikatorBelum',
            'pctKegiatan', 'pctVariabel', 'pctIndikator'
        ));
    }

    public function aliranData(Request $request)
    {
        $request->validate(['tahun' => 'nullable|integer|min:2020|max:2099']);
        $tahun = (int) $request->query('tahun', KegiatanStatistik::max('tahun') ?? date('Y'));

        $query = AliranData::with('kegiatanStatistik.dinas')->where('tahun', $tahun);

        if ($request->filled('dinasFilter')) {
            $query->whereHas('kegiatanStatistik', function($q) use ($request) {
                $q->where('dinas_id', $request->dinasFilter);
            });
        }
        if ($request->filled('status')) {
            $query->where('sudah_tayang', $request->status == '1');
        }
        if ($request->filled('search')) {
            $search = str_replace(['%', '_'], ['\\%', '\\_'], $request->search);
            $query->where(function($q) use ($search) {
                $q->where('nama_data', 'like', "%{$search}%")
                  ->orWhereHas('kegiatanStatistik', function($q2) use ($search) {
                      $q2->where('nama', 'like', "%{$search}%")
                         ->orWhereHas('dinas', function($q3) use ($search) {
                             $q3->where('nama', 'like', "%{$search}%")->orWhere('singkatan', 'like', "%{$search}%");
                         });
                  });
            });
        }

        $aliranData = $query->paginate(10)->withQueryString();
        $dinasList = Dinas::orderBy('nama')->get();

        // Summary Calculations
        $totalData = AliranData::where('tahun', $tahun)->count();
        $sudahTayang = AliranData::where('tahun', $tahun)->where('sudah_tayang', true)->count();
        $belumTayang = max(0, $totalData - $sudahTayang);

        $pctTayang = $totalData > 0 ? round(($sudahTayang / $totalData) * 100) : 0;
        $pctBelum = $totalData > 0 ? round(($belumTayang / $totalData) * 100) : 0;

        return view('public.aliran_data', compact(
            'aliranData', 'tahun', 'dinasList',
            'totalData', 'sudahTayang', 'belumTayang', 'pctTayang', 'pctBelum'
        ));
    }

    public function monev(Request $request)
    {
        $request->validate(['tahun' => 'nullable|integer|min:2020|max:2099']);
        $tahun = (int) $request->query('tahun', date('Y'));

        return view('public.monev', compact('tahun'));
    }

    public function pembinaan(Request $request)
    {
        $request->validate(['tahun' => 'nullable|integer|min:2020|max:2099']);
        $tahun = (int) $request->query('tahun', date('Y'));



        $sesiPembinaan = Pembinaan::whereYear('tanggal', $tahun)
            ->orderBy('tanggal')
            ->get();

        $materiPembinaan = MateriPembinaan::orderByDesc('tanggal')
            ->get();

        $latestKegiatanPendampingan = KegiatanPendampingan::orderByDesc('tanggal')
            ->take(3)
            ->get();

        $dinasList = Dinas::orderBy('nama')->get();

        // Calculate Kehadiran Per OPD
        // We want a structure like: dinas_id => ['dinas' => Dinas, 'kehadiran' => [sesi_id => boolean], 'total' => int]
        $rekapKehadiran = [];
        foreach ($dinasList as $dinas) {
            $rekapKehadiran[$dinas->id] = [
                'dinas' => $dinas,
                'kehadiran' => [],
                'total' => 0,
            ];
            foreach ($sesiPembinaan as $sesi) {
                // Find presensi for this dinas and sesi
                $presensi = $sesi->presensi->where('dinas_id', $dinas->id)->first();
                $hadir = $presensi ? $presensi->hadir : false;
                $rekapKehadiran[$dinas->id]['kehadiran'][$sesi->id] = $hadir;
                if ($hadir) {
                    $rekapKehadiran[$dinas->id]['total']++;
                }
            }
        }

        // Calculate total attendance rate
        $totalSesi = $sesiPembinaan->count();
        $totalOPD = $dinasList->count();
        $totalKehadiran = 0;
        foreach ($rekapKehadiran as $rekap) {
            $totalKehadiran += $rekap['total'];
        }
        $maxKehadiran = $totalSesi * $totalOPD;
        $persentaseKehadiran = $maxKehadiran > 0 ? round(($totalKehadiran / $maxKehadiran) * 100) : 0;

        return view('public.pembinaan', compact(
            'tahun',
            'sesiPembinaan',
            'materiPembinaan',
            'rekapKehadiran',
            'totalSesi',
            'totalOPD',
            'totalKehadiran',
            'persentaseKehadiran',
            'dinasList',
            'latestKegiatanPendampingan'
        ));
    }
}
