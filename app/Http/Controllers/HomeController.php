<?php

namespace App\Http\Controllers;

use App\Enums\JenisMetadata;
use App\Enums\StatusDinas;
use App\Enums\StatusKominfo;
use App\Enums\StatusMonev;
use App\Exports\MonevExport;
use App\Models\AliranData;
use App\Models\BeritaAcara;
use App\Models\Dinas;
use App\Models\KegiatanStatistik;
use App\Models\Metadata;
use App\Models\Monev;
use App\Models\Romantik;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    public function beritaAcara()
    {
        $beritaAcara = BeritaAcara::latest('tanggal')->paginate(9);
        return view('berita-acara', compact('beritaAcara'));
    }

    public function index(Request $request)
    {
        $request->validate([
            'tahun' => 'nullable|integer|min:2020|max:2099',
        ]);

        $tahun = (int) $request->input('tahun', date('Y'));

        // --- Summary Cards ---
        $totalKegiatan = KegiatanStatistik::where('tahun', $tahun)->count();
        $totalDinas    = Dinas::count();

        // Romantik
        $romantikDiajukan = Romantik::where('tahun', $tahun)
            ->whereIn('status_dinas', StatusDinas::submittedValues())->count();
        $romantikBelum = Romantik::where('tahun', $tahun)
            ->where('status_dinas', StatusDinas::BELUM_DIAJUKAN->value)->count();

        // Metadata (per jenis)
        $metaKegiatan = Metadata::where('tahun', $tahun)->where('jenis', JenisMetadata::KEGIATAN->value);
        $metaKegiatanDone = (clone $metaKegiatan)->whereIn('status_kominfo', StatusKominfo::completedValues())->count();
        $metaKegiatanTotal = $metaKegiatan->count();

        $metaVariabel = Metadata::where('tahun', $tahun)->where('jenis', JenisMetadata::VARIABEL->value);
        $metaVariabelDone = (clone $metaVariabel)->whereIn('status_kominfo', StatusKominfo::completedValues())->count();
        $metaVariabelTotal = $metaVariabel->count();

        $metaIndikator = Metadata::where('tahun', $tahun)->where('jenis', JenisMetadata::INDIKATOR->value);
        $metaIndikatorDone = (clone $metaIndikator)->whereIn('status_kominfo', StatusKominfo::completedValues())->count();
        $metaIndikatorTotal = $metaIndikator->count();

        // Aliran Data
        $aliranTayang = AliranData::where('tahun', $tahun)->where('sudah_tayang', true)->count();
        $aliranBelum  = AliranData::where('tahun', $tahun)->where('sudah_tayang', false)->count();
        $aliranTotal  = $aliranTayang + $aliranBelum;

        // --- Bar Chart (kegiatan per tahun) — single optimized query ---
        $yearRange = config('paseban.chart_year_range', 5);
        $startYear = $tahun - ($yearRange - 1);

        $chartData = KegiatanStatistik::select('tahun', DB::raw('COUNT(*) as total'))
            ->whereBetween('tahun', [$startYear, $tahun])
            ->groupBy('tahun')
            ->orderBy('tahun')
            ->pluck('total', 'tahun');

        $chartYears = [];
        $chartValues = [];
        for ($y = $startYear; $y <= $tahun; $y++) {
            $chartYears[] = (string) $y;
            $chartValues[] = $chartData->get($y, 0);
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

        // --- Monthly data for hero chart ---
        $getMonthly = function($model) use ($tahun) {
            $data = $model::select(DB::raw('MONTH(created_at) as m'), DB::raw('COUNT(*) as c'))
                ->where('tahun', $tahun)->groupBy('m')->pluck('c', 'm');
            $arr = [];
            for ($i = 1; $i <= 12; $i++) {
                $arr[] = $data->get($i, 0);
            }
            return $arr;
        };
        $heroMonthlyRomantik = $getMonthly(new Romantik);
        $heroMonthlyMetadata = $getMonthly(new Metadata);
        $heroMonthlyAliran = $getMonthly(new AliranData);

        return view('home', compact(
            'tahun', 'totalKegiatan', 'totalDinas', 'tingkatRespon',
            'romantikDiajukan', 'romantikBelum',
            'metaKegiatanDone', 'metaKegiatanTotal',
            'metaVariabelDone', 'metaVariabelTotal',
            'metaIndikatorDone', 'metaIndikatorTotal',
            'aliranTayang', 'aliranBelum', 'aliranTotal',
            'chartYears', 'chartValues',
            'heroMonthlyRomantik', 'heroMonthlyMetadata', 'heroMonthlyAliran',
            'pctRomantik', 'pctMetadata', 'pctAliran',
            'beritaAcara'
        ));
    }

    public function exportExcel(Request $request)
    {
        $request->validate([
            'tahun' => 'nullable|integer|min:2020|max:2099',
            'dinas_id' => 'nullable|integer|exists:dinas,id',
            'status' => ['nullable', 'string', \Illuminate\Validation\Rule::in(StatusMonev::values())],
            'search' => 'nullable|string|max:100',
        ]);

        $tahun = (int) $request->input('tahun', date('Y'));

        return Excel::download(
            new MonevExport($tahun, $request->input('dinas_id'), $request->input('status'), $request->input('search')),
            'monev_kegiatan_' . $tahun . '.xlsx'
        );
    }

    public function exportPdf(Request $request)
    {
        $request->validate([
            'tahun' => 'nullable|integer|min:2020|max:2099',
            'dinas_id' => 'nullable|integer|exists:dinas,id',
            'status' => ['nullable', 'string', \Illuminate\Validation\Rule::in(StatusMonev::values())],
            'search' => 'nullable|string|max:100',
        ]);

        $tahun = (int) $request->input('tahun', date('Y'));
        $monevQuery = Monev::with('kegiatanStatistik.dinas')->where('tahun', $tahun);

        if ($request->filled('dinas_id')) {
            $monevQuery->whereHas('kegiatanStatistik', function ($q) use ($request) {
                $q->where('dinas_id', (int) $request->input('dinas_id'));
            });
        }
        if ($request->filled('status')) {
            $monevQuery->where('status', $request->input('status'));
        }
        if ($request->filled('search')) {
            $monevQuery->whereHas('kegiatanStatistik', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . str_replace(['%', '_'], ['\%', '\_'], $request->input('search')) . '%');
            });
        }

        $monevItems = $monevQuery->get();

        $pdf = Pdf::loadView('exports.monev_pdf', compact('monevItems', 'tahun'))->setPaper('a4', 'landscape');
        return $pdf->download('monev_kegiatan_' . $tahun . '.pdf');
    }
}
