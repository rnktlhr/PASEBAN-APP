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
