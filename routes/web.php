<?php

use App\Http\Controllers\DashboardApiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', fn () => redirect('/dinas/login'))->name('login');
Route::get('/kegiatan/berita-acara', [HomeController::class, 'beritaAcara'])->name('berita-acara.index');
Route::get('/kegiatan/berita-acara/{beritaAcara}', [\App\Http\Controllers\BeritaAcaraController::class, 'show'])->name('berita-acara.show');

// Export routes
Route::middleware(['throttle:exports'])->group(function () {
    Route::get('/monev/export/excel', [HomeController::class, 'exportExcel'])->name('monev.export.excel');
    Route::get('/monev/export/pdf', [HomeController::class, 'exportPdf'])->name('monev.export.pdf');
    
    Route::get('/kegiatan/export', [HomeController::class, 'exportKegiatanStatistik'])->name('kegiatan.export');
    Route::get('/metadata/export', [HomeController::class, 'exportMetadata'])->name('metadata.export');
    Route::get('/romantik/export', [HomeController::class, 'exportRomantik'])->name('romantik.export');
    Route::get('/aliran-data/export', [HomeController::class, 'exportAliranData'])->name('aliran-data.export');
});

// Public data views
Route::get('/kegiatan', [PublicController::class, 'kegiatan'])->name('public.kegiatan');
Route::get('/romantik', [PublicController::class, 'romantik'])->name('public.romantik');
Route::get('/metadata', [PublicController::class, 'metadata'])->name('public.metadata');
Route::get('/aliran-data', [PublicController::class, 'aliranData'])->name('public.aliran_data');
Route::get('/pembinaan', [PublicController::class, 'pembinaan'])->name('public.pembinaan');
Route::get('/monitoring-evaluasi', [PublicController::class, 'monev'])->name('public.monev');

// API Routes for Dashboard (Used on public home page, so no auth middleware)
Route::middleware(['throttle:60,1'])->group(function () {
    Route::get('/api/dashboard/chart-data', [DashboardApiController::class, 'getChartData'])->name('api.dashboard.chart-data');
    Route::get('/api/dashboard/chart-details', [DashboardApiController::class, 'getChartDetails'])->name('api.dashboard.chart-details');
});

