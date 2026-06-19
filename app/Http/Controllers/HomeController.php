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

        $defaultTahun = KegiatanStatistik::max('tahun') ?? (int) date('Y');
        $tahun = (int) $request->input('tahun', $defaultTahun);

        // --- Summary Cards ---
        $totalKegiatan = KegiatanStatistik::where('tahun', $tahun)->count();
        $totalDinas    = Dinas::count();

        // Romantik
        $romantikTotal = Romantik::where('tahun', $tahun)->count();
        $romantikDiajukan = Romantik::where('tahun', $tahun)
            ->whereIn('status_dinas', StatusDinas::submittedValues())->count();
        $romantikBelum = $romantikTotal - $romantikDiajukan;

        // Metadata (Gabungan 3 Jenis: Kegiatan, Variabel, Indikator)
        $metaKegiatan = Metadata::where('tahun', $tahun)->where('jenis', JenisMetadata::KEGIATAN->value);
        $metaKegiatanDone = (clone $metaKegiatan)->whereIn('status_kominfo', StatusKominfo::completedValues())->count();
        $metaKegiatanDraft = (clone $metaKegiatan)->where('status_kominfo', StatusKominfo::DRAFT->value)->count();

        $metaVariabel = Metadata::where('tahun', $tahun)->where('jenis', JenisMetadata::VARIABEL->value);
        $metaVariabelDone = (clone $metaVariabel)->whereIn('status_kominfo', StatusKominfo::completedValues())->count();
        $metaVariabelDraft = (clone $metaVariabel)->where('status_kominfo', StatusKominfo::DRAFT->value)->count();

        $metaIndikator = Metadata::where('tahun', $tahun)->where('jenis', JenisMetadata::INDIKATOR->value);
        $metaIndikatorDone = (clone $metaIndikator)->whereIn('status_kominfo', StatusKominfo::completedValues())->count();
        $metaIndikatorDraft = (clone $metaIndikator)->where('status_kominfo', StatusKominfo::DRAFT->value)->count();

        $metaTotalDone = $metaKegiatanDone + $metaVariabelDone + $metaIndikatorDone;
        $metaTotalDraft = $metaKegiatanDraft + $metaVariabelDraft + $metaIndikatorDraft;
        
        $metaTotalTarget = $totalKegiatan * 3; // Karena ada 3 jenis metadata per Kegiatan
        $metaTotalBelum = max(0, $metaTotalTarget - $metaTotalDone - $metaTotalDraft);

        // Alias for the view to use
        $metaKegiatanDone = $metaTotalDone;
        $metaKegiatanDraft = $metaTotalDraft;
        $metaKegiatanTotal = $metaTotalTarget;

        // Aliran Data
        $aliranTotal  = AliranData::where('tahun', $tahun)->count();
        $aliranTayang = AliranData::where('tahun', $tahun)->where('sudah_tayang', true)->count();
        $aliranBelum  = $aliranTotal - $aliranTayang;

        // --- Pie Chart (kegiatan per jenis) ---
        $jenisLabels = [];
        $jenisValues = [];
        $jenisColors = [];
        foreach (\App\Enums\JenisKegiatan::cases() as $jenis) {
            $jenisLabels[] = $jenis->label();
            $jenisValues[] = KegiatanStatistik::where('tahun', $tahun)->where('jenis', $jenis->value)->count();
            $jenisColors[] = match($jenis) {
                \App\Enums\JenisKegiatan::SURVEI => '#002B6A',
                \App\Enums\JenisKegiatan::PENDATAAN_LENGKAP => '#00B69B',
                \App\Enums\JenisKegiatan::KOMPROMIN => '#EB891B',
            };
        }

        // --- Donut percentages ---
        $pctRomantik = $totalKegiatan > 0 ? round($romantikDiajukan / $totalKegiatan * 100) : 0;
        $pctMetadata = $metaKegiatanTotal > 0 ? round($metaKegiatanDone / $metaKegiatanTotal * 100) : 0;
        $pctAliran   = $aliranTotal > 0 ? round($aliranTayang / $aliranTotal * 100) : 0;

        // --- Tingkat Respon ---
        $tingkatRespon = $romantikTotal > 0 ? round(($romantikDiajukan / $romantikTotal) * 100) : 0;

        // --- Berita Acara (latest 3) ---
        $beritaAcara = BeritaAcara::orderBy('tanggal', 'desc')->take(10)->get();

        // --- Monthly data for hero chart ---
        $getMonthly = function($query) use ($tahun) {
            $data = $query->select(DB::raw('MONTH(created_at) as m'), DB::raw('COUNT(*) as c'))
                ->where('tahun', $tahun)
                ->groupBy(DB::raw('MONTH(created_at)'))
                ->pluck('c', 'm');
            $arr = [];
            for ($i = 1; $i <= 12; $i++) {
                $arr[] = $data->get($i, 0);
            }
            return $arr;
        };

        $heroMonthlyRomantik = $getMonthly(Romantik::whereIn('status_dinas', StatusDinas::submittedValues()));
        $heroMonthlyMetadata = $getMonthly(Metadata::where('jenis', JenisMetadata::KEGIATAN->value)->whereIn('status_kominfo', StatusKominfo::completedValues()));
        $heroMonthlyAliran = $getMonthly(AliranData::where('sudah_tayang', true));

        // --- Pembinaan Kehadiran ---
        $totalSesiPembinaan = \App\Models\Pembinaan::whereYear('tanggal', $tahun)->count();
        $totalKehadiran = \App\Models\PresensiPembinaan::whereHas('pembinaan', function($q) use ($tahun) {
            $q->whereYear('tanggal', $tahun);
        })->where('hadir', true)->count();
        $maxKehadiran = $totalSesiPembinaan * $totalDinas;
        $pctKehadiran = $maxKehadiran > 0 ? round(($totalKehadiran / $maxKehadiran) * 100) : 0;

        return view('home', compact(
            'tahun', 'totalKegiatan', 'totalDinas', 'tingkatRespon',
            'romantikDiajukan', 'romantikBelum',
            'metaKegiatanDone', 'metaKegiatanDraft', 'metaKegiatanTotal',
            'metaVariabelDone', 'metaVariabelTotal',
            'metaIndikatorDone', 'metaIndikatorTotal',
            'aliranTayang', 'aliranBelum', 'aliranTotal',
            'jenisLabels', 'jenisValues', 'jenisColors',
            'heroMonthlyRomantik', 'heroMonthlyMetadata', 'heroMonthlyAliran',
            'pctRomantik', 'pctMetadata', 'pctAliran',
            'totalSesiPembinaan', 'totalKehadiran', 'maxKehadiran', 'pctKehadiran',
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

        $tahun = (int) $request->input('tahun', KegiatanStatistik::max('tahun') ?? date('Y'));

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

        $tahun = (int) $request->input('tahun', KegiatanStatistik::max('tahun') ?? date('Y'));
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

    public function exportKegiatanStatistik(Request $request)
    {
        $request->validate([
            'tahun' => 'nullable|integer|min:2020|max:2099',
            'dinas_id' => 'nullable|integer|exists:dinas,id',
            'jenis' => 'nullable|string|in:survei,pendataan_lengkap,kompromin',
            'search' => 'nullable|string|max:100',
            'format' => 'nullable|string|in:excel,pdf',
        ]);

        $tahun = (int) $request->input('tahun', KegiatanStatistik::max('tahun') ?? date('Y'));
        $format = $request->input('format', 'excel');
        
        $export = new \App\Exports\KegiatanStatistikExport($tahun, $request->input('dinas_id'), $request->input('jenis'), $request->input('search'));
        
        if ($format === 'pdf') {
            $viewData = $export->view()->getData();
            $pdf = Pdf::loadView('exports.kegiatan_statistik_pdf', $viewData)
                ->setPaper('a4', 'landscape');
            return $pdf->download("Identifikasi_Kegiatan_Statistik_{$tahun}.pdf");
        }

        return Excel::download($export, "Identifikasi_Kegiatan_Statistik_{$tahun}.xlsx");
    }

    public function exportMetadata(Request $request)
    {
        $request->validate([
            'tahun' => 'nullable|integer|min:2020|max:2099',
            'dinas_id' => 'nullable|integer|exists:dinas,id',
            'jenis' => 'nullable|string|in:kegiatan,variabel,indikator',
            'search' => 'nullable|string|max:100',
            'format' => 'nullable|string|in:excel,pdf',
        ]);

        $tahun = (int) $request->input('tahun', KegiatanStatistik::max('tahun') ?? date('Y'));
        $format = $request->input('format', 'excel');
        
        $export = new \App\Exports\MetadataExport($tahun, $request->input('dinas_id'), $request->input('jenis'), $request->input('search'));
        
        if ($format === 'pdf') {
            $viewData = $export->view()->getData();
            $pdf = Pdf::loadView('exports.metadata_pdf', $viewData)
                ->setPaper('a4', 'landscape');
            return $pdf->download("Metadata_Statistik_{$tahun}.pdf");
        }

        return Excel::download($export, "Metadata_Statistik_{$tahun}.xlsx");
    }

    public function exportRomantik(Request $request)
    {
        $request->validate([
            'tahun' => 'nullable|integer|min:2020|max:2099',
            'dinas_id' => 'nullable|integer|exists:dinas,id',
            'status' => 'nullable|string|in:done,belum',
            'search' => 'nullable|string|max:100',
            'format' => 'nullable|string|in:excel,pdf',
        ]);

        $tahun = (int) $request->input('tahun', KegiatanStatistik::max('tahun') ?? date('Y'));
        $format = $request->input('format', 'excel');
        
        $export = new \App\Exports\RomantikExport($tahun, $request->input('dinas_id'), $request->input('status'), $request->input('search'));
        
        if ($format === 'pdf') {
            $viewData = $export->view()->getData();
            $pdf = Pdf::loadView('exports.romantik_pdf', $viewData)
                ->setPaper('a4', 'landscape');
            return $pdf->download("Romantik_Statistik_{$tahun}.pdf");
        }

        return Excel::download($export, "Romantik_Statistik_{$tahun}.xlsx");
    }

    public function exportAliranData(Request $request)
    {
        $request->validate([
            'tahun' => 'nullable|integer|min:2020|max:2099',
            'dinas_id' => 'nullable|integer|exists:dinas,id',
            'status' => 'nullable|string|in:1,0',
            'search' => 'nullable|string|max:100',
            'format' => 'nullable|string|in:excel,pdf',
        ]);

        $tahun = (int) $request->input('tahun', KegiatanStatistik::max('tahun') ?? date('Y'));
        $format = $request->input('format', 'excel');
        
        $export = new \App\Exports\AliranDataExport($tahun, $request->input('dinas_id'), $request->input('status'), $request->input('search'));
        
        if ($format === 'pdf') {
            $viewData = $export->view()->getData();
            $pdf = Pdf::loadView('exports.aliran_data_pdf', $viewData)
                ->setPaper('a4', 'landscape');
            return $pdf->download("Aliran_Data_Sedata_Sebantul_{$tahun}.pdf");
        }

        return Excel::download($export, "Aliran_Data_Sedata_Sebantul_{$tahun}.xlsx");
    }
}
