<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', fn () => redirect('/dinas/login'))->name('public.login');
Route::get('/kegiatan/berita-acara', [HomeController::class, 'beritaAcara'])->name('berita-acara.index');
Route::get('/monev/export/excel', [HomeController::class, 'exportExcel'])->middleware('throttle:exports')->name('monev.export.excel');
Route::get('/monev/export/pdf', [HomeController::class, 'exportPdf'])->middleware('throttle:exports')->name('monev.export.pdf');

Route::get('/kegiatan', [\App\Http\Controllers\PublicController::class, 'kegiatan'])->name('public.kegiatan');
Route::get('/romantik', [\App\Http\Controllers\PublicController::class, 'romantik'])->name('public.romantik');
Route::get('/metadata', [\App\Http\Controllers\PublicController::class, 'metadata'])->name('public.metadata');
Route::get('/aliran-data', [\App\Http\Controllers\PublicController::class, 'aliranData'])->name('public.aliran_data');
Route::get('/monitoring-evaluasi', [\App\Http\Controllers\PublicController::class, 'monev'])->name('public.monev');
