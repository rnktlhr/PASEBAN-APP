<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', fn () => redirect('/dinas/login'))->name('public.login');
Route::get('/kegiatan/berita-acara', [HomeController::class, 'beritaAcara'])->name('berita-acara.index');
Route::get('/kegiatan/berita-acara/{beritaAcara}', [\App\Http\Controllers\BeritaAcaraController::class, 'show'])->name('berita-acara.show');

// Export routes — require authentication to prevent unauthorized data downloads
Route::middleware(['auth', 'throttle:exports'])->group(function () {
    Route::get('/monev/export/excel', [HomeController::class, 'exportExcel'])->name('monev.export.excel');
    Route::get('/monev/export/pdf', [HomeController::class, 'exportPdf'])->name('monev.export.pdf');
});

// Public data views
Route::get('/kegiatan', [PublicController::class, 'kegiatan'])->name('public.kegiatan');
Route::get('/romantik', [PublicController::class, 'romantik'])->name('public.romantik');
Route::get('/metadata', [PublicController::class, 'metadata'])->name('public.metadata');
Route::get('/aliran-data', [PublicController::class, 'aliranData'])->name('public.aliran_data');
Route::get('/monitoring-evaluasi', [PublicController::class, 'monev'])->name('public.monev');

// Temporary route to clear stuck sessions
Route::get('/force-logout', function () {
    auth()->logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/admin');
});
