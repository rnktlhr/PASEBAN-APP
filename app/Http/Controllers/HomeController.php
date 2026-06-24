<?php

namespace App\Http\Controllers;

use App\Enums\StatusMonev;
use App\Exports\MonevExport;
use App\Models\KegiatanPendampingan;
use App\Models\KegiatanStatistik;
use App\Models\Monev;
use App\Services\DashboardService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    public function __construct(
        protected DashboardService $dashboardService
    ) {}

    public function kegiatanPendampingan()
    {
        $kegiatanPendampingan = KegiatanPendampingan::latest('tanggal')->paginate(9);
        return view('kegiatan-pendampingan', compact('kegiatanPendampingan'));
    }

    public function loginRedirect()
    {
        return redirect('/dinas/login');
    }

    public function apiUser(Request $request)
    {
        return $request->user();
    }

    public function index(Request $request)
    {
        $request->validate([
            'tahun' => 'nullable|integer|min:2020|max:2099',
        ]);

        $tahun = (int) $request->input('tahun', $this->dashboardService->getDefaultTahun());

        // Delegate business logic ke DashboardService (SRP)
        $summaryCards = $this->dashboardService->getSummaryCards($tahun);
        $chartData = $this->dashboardService->getChartData($tahun);
        $monthlyTrends = $this->dashboardService->getMonthlyTrends($tahun);
        $pembinaanStats = $this->dashboardService->getPembinaanStats($tahun);

        // Kegiatan Pendampingan (latest 10)
        $kegiatanPendampingan = KegiatanPendampingan::orderBy('tanggal', 'desc')->take(10)->get();

        return view('home', array_merge(
            $summaryCards,
            $chartData,
            $monthlyTrends,
            $pembinaanStats,
            compact('kegiatanPendampingan')
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
