<?php

namespace App\Http\Controllers;

use App\Models\AliranData;
use App\Models\BeritaAcara;
use App\Models\Dinas;
use App\Models\KegiatanStatistik;
use App\Models\Metadata;
use App\Models\Monev;
use App\Models\Romantik;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function beritaAcara()
    {
        $beritaAcara = BeritaAcara::latest('tanggal')->paginate(9);
        return view('berita-acara', compact('beritaAcara'));
    }

    public function index(Request $request)
    {
        $tahun = (int) $request->input('tahun', date('Y'));

        // --- Summary Cards ---
        $totalKegiatan = KegiatanStatistik::where('tahun', $tahun)->count();
        $totalDinas    = Dinas::count();

        // Romantik
        $romantikDiajukan = Romantik::where('tahun', $tahun)
            ->whereIn('status_dinas', ['sudah_diajukan', 'sudah_diperbaiki'])->count();
        $romantikBelum = Romantik::where('tahun', $tahun)
            ->where('status_dinas', 'belum_diajukan')->count();

        // Metadata (per jenis)
        $metaKegiatan = Metadata::where('tahun', $tahun)->where('jenis', 'kegiatan');
        $metaKegiatanDone = (clone $metaKegiatan)->whereIn('status_kominfo', ['submit', 'sudah_diperbaiki', 'disetujui'])->count();
        $metaKegiatanTotal = $metaKegiatan->count();

        $metaVariabel = Metadata::where('tahun', $tahun)->where('jenis', 'variabel');
        $metaVariabelDone = (clone $metaVariabel)->whereIn('status_kominfo', ['submit', 'sudah_diperbaiki', 'disetujui'])->count();
        $metaVariabelTotal = $metaVariabel->count();

        $metaIndikator = Metadata::where('tahun', $tahun)->where('jenis', 'indikator');
        $metaIndikatorDone = (clone $metaIndikator)->whereIn('status_kominfo', ['submit', 'sudah_diperbaiki', 'disetujui'])->count();
        $metaIndikatorTotal = $metaIndikator->count();

        // Aliran Data
        $aliranTayang = AliranData::where('tahun', $tahun)->where('sudah_tayang', true)->count();
        $aliranBelum  = AliranData::where('tahun', $tahun)->where('sudah_tayang', false)->count();
        $aliranTotal  = $aliranTayang + $aliranBelum;

        // --- Bar Chart (kegiatan per tahun) ---
        $chartYears = [];
        $chartValues = [];
        for ($y = $tahun - 4; $y <= $tahun; $y++) {
            $chartYears[] = (string) $y;
            $chartValues[] = KegiatanStatistik::where('tahun', $y)->count();
        }

        // --- Donut percentages ---
        $pctRomantik = $totalKegiatan > 0 ? round($romantikDiajukan / $totalKegiatan * 100) : 0;
        $pctMetadata = $metaKegiatanTotal > 0 ? round($metaKegiatanDone / $metaKegiatanTotal * 100) : 0;
        $pctAliran   = $aliranTotal > 0 ? round($aliranTayang / $aliranTotal * 100) : 0;

        // --- Tingkat Respon ---
        $romantikTotal = Romantik::where('tahun', $tahun)->count();
        $tingkatRespon = $romantikTotal > 0 ? round(($romantikDiajukan / $romantikTotal) * 100) : 0;

        // --- Berita Acara (latest 3) ---
        $beritaAcara = BeritaAcara::orderBy('tanggal', 'desc')->take(3)->get();

        return view('home', compact(
            'tahun', 'totalKegiatan', 'totalDinas', 'tingkatRespon',
            'romantikDiajukan', 'romantikBelum',
            'metaKegiatanDone', 'metaKegiatanTotal',
            'metaVariabelDone', 'metaVariabelTotal',
            'metaIndikatorDone', 'metaIndikatorTotal',
            'aliranTayang', 'aliranBelum', 'aliranTotal',
            'chartYears', 'chartValues',
            'pctRomantik', 'pctMetadata', 'pctAliran',
            'beritaAcara'
        ));
    }

    public function exportExcel(Request $request)
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\MonevExport($request), 'monev_kegiatan_'.$request->input('tahun', date('Y')).'.xlsx');
    }

    public function exportPdf(Request $request)
    {
        $tahun = (int) $request->input('tahun', date('Y'));
        $monevQuery = Monev::with('kegiatanStatistik.dinas')->where('tahun', $tahun);
        
        if ($request->filled('dinas_id')) {
            $monevQuery->whereHas('kegiatanStatistik', function($q) use ($request) {
                $q->where('dinas_id', $request->dinas_id);
            });
        }
        if ($request->filled('status')) {
            $monevQuery->where('status', $request->status);
        }
        if ($request->filled('search')) {
            $monevQuery->whereHas('kegiatanStatistik', function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%');
            });
        }
        
        $monevItems = $monevQuery->get();
        
        // Load PDF using dompdf
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('exports.monev_pdf', compact('monevItems', 'tahun'))->setPaper('a4', 'landscape');
        return $pdf->download('monev_kegiatan_'.$tahun.'.pdf');
    }
}
