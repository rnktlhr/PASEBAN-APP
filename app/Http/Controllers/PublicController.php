<?php

namespace App\Http\Controllers;

use App\Models\AliranData;
use App\Models\KegiatanStatistik;
use App\Models\Metadata;
use App\Models\Monev;
use App\Models\Romantik;
use App\Models\Dinas;
use App\Models\ProgramPembinaan;
use App\Models\Pembinaan;
use App\Models\MateriPembinaan;
use App\Models\BeritaAcara;
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
            $search = $request->search;
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
            $search = $request->search;
            $query->whereHas('kegiatanStatistik', function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhereHas('dinas', function($q2) use ($search) {
                      $q2->where('nama', 'like', "%{$search}%")->orWhere('singkatan', 'like', "%{$search}%");
                  });
            });
        }

        $romantik = $query->paginate(10)->withQueryString();
        $dinasList = Dinas::orderBy('nama')->get();

        return view('public.romantik', compact('romantik', 'tahun', 'dinasList'));
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
            $search = $request->search;
            $query->whereHas('kegiatanStatistik', function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhereHas('dinas', function($q2) use ($search) {
                      $q2->where('nama', 'like', "%{$search}%")->orWhere('singkatan', 'like', "%{$search}%");
                  });
            });
        }

        $metadata = $query->orderBy('kegiatan_id')->orderBy('jenis')->paginate(10)->withQueryString();
        $dinasList = Dinas::orderBy('nama')->get();

        return view('public.metadata', compact('metadata', 'tahun', 'dinasList'));
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
            $search = $request->search;
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

        return view('public.aliran_data', compact('aliranData', 'tahun', 'dinasList'));
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

        $programPembinaan = ProgramPembinaan::where('tahun', $tahun)
            ->orderBy('nomor_urut')
            ->get();

        $sesiPembinaan = Pembinaan::whereYear('tanggal', $tahun)
            ->orderBy('tanggal')
            ->get();

        $materiPembinaan = MateriPembinaan::orderByDesc('tanggal')
            ->get();

        $latestBeritaAcara = BeritaAcara::orderByDesc('tanggal')
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
            'programPembinaan',
            'sesiPembinaan',
            'materiPembinaan',
            'rekapKehadiran',
            'totalSesi',
            'totalOPD',
            'totalKehadiran',
            'persentaseKehadiran',
            'dinasList',
            'latestBeritaAcara'
        ));
    }
}
