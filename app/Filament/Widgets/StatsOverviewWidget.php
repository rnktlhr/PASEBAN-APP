<?php

namespace App\Filament\Widgets;

use App\Models\AliranData;
use App\Models\KegiatanStatistik;
use App\Models\Metadata;
use App\Models\Monev;
use App\Models\Romantik;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $tahun = (int) date('Y');

        $totalKegiatan = KegiatanStatistik::where('tahun', $tahun)->count();
        $romantikDisetujui = Romantik::where('tahun', $tahun)->where('status_bps', 'disetujui')->count();
        $metadataSelesai = Metadata::where('tahun', $tahun)->where('status_bps', 'disetujui')->count();
        $aliranTayang = AliranData::where('tahun', $tahun)->where('sudah_tayang', true)->count();
        $aliranTotal = AliranData::where('tahun', $tahun)->count();
        $monevTepat = Monev::where('tahun', $tahun)->where('status', 'tepat_waktu')->count();
        $monevTerlambat = Monev::where('tahun', $tahun)->where('status', 'terlambat')->count();

        return [
            Stat::make('Kegiatan Statistik ' . $tahun, $totalKegiatan)
                ->description('Total kegiatan tahun ini')
                ->descriptionIcon('heroicon-m-clipboard-document-list')
                ->color('primary'),
            Stat::make('Romantik Disetujui', $romantikDisetujui . ' / ' . $totalKegiatan)
                ->description(($totalKegiatan > 0 ? round($romantikDisetujui / $totalKegiatan * 100) : 0) . '% disetujui BPS')
                ->color('success'),
            Stat::make('Metadata Disetujui', $metadataSelesai)
                ->description('Dari 3 jenis × ' . $totalKegiatan . ' kegiatan')
                ->color('warning'),
            Stat::make('Aliran Data Tayang', $aliranTayang . ' / ' . $aliranTotal)
                ->description('Di Sedata Sebantul')
                ->color('success'),
            Stat::make('Tepat Waktu', $monevTepat)
                ->description('Kegiatan selesai tepat waktu')
                ->color('success'),
            Stat::make('Terlambat', $monevTerlambat)
                ->description('Kegiatan terlambat')
                ->color('danger'),
        ];
    }
}
