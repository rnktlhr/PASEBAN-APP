<?php

namespace App\Services;

use App\Enums\JenisKegiatan;
use App\Enums\JenisMetadata;
use App\Enums\StatusDinas;
use App\Enums\StatusKominfo;
use App\Models\KegiatanStatistik;
use App\Models\Metadata;
use App\Models\Pembinaan;
use App\Models\PresensiPembinaan;
use App\Models\Romantik;
use App\Models\Dinas;
use App\Models\KegiatanPendampingan;
use Illuminate\Support\Facades\DB;

/**
 * Service class untuk business logic dashboard.
 *
 * Mengikuti Single Responsibility Principle (SRP):
 * Controller hanya menerima request dan return response,
 * sedangkan service menangani business logic dan query data.
 */
class DashboardService
{
    /**
     * Ambil data ringkasan kartu statistik (summary cards) untuk dashboard.
     *
     * @return array Berisi semua variabel untuk summary cards
     */
    public function getSummaryCards(int $tahun): array
    {
        $totalKegiatan = KegiatanStatistik::where('tahun', $tahun)->count();
        $totalDinas = Dinas::count();

        // Romantik
        $romantikTotal = Romantik::where('tahun', $tahun)->count();
        $romantikDiajukan = Romantik::where('tahun', $tahun)
            ->whereIn('status_dinas', StatusDinas::submittedValues())->count();
        $romantikBelum = $romantikTotal - $romantikDiajukan;

        // Metadata (Gabungan 3 Jenis: Kegiatan, Variabel, Indikator)
        $metaKegiatanQuery = Metadata::where('tahun', $tahun)->where('jenis', JenisMetadata::KEGIATAN->value);
        $metaKegiatanDone = (clone $metaKegiatanQuery)->whereIn('status_kominfo', StatusKominfo::completedValues())->count();
        $metaKegiatanDraft = (clone $metaKegiatanQuery)->where('status_kominfo', StatusKominfo::DRAFT->value)->count();

        $metaVariabelQuery = Metadata::where('tahun', $tahun)->where('jenis', JenisMetadata::VARIABEL->value);
        $metaVariabelDone = (clone $metaVariabelQuery)->whereIn('status_kominfo', StatusKominfo::completedValues())->count();
        $metaVariabelDraft = (clone $metaVariabelQuery)->where('status_kominfo', StatusKominfo::DRAFT->value)->count();

        $metaIndikatorQuery = Metadata::where('tahun', $tahun)->where('jenis', JenisMetadata::INDIKATOR->value);
        $metaIndikatorDone = (clone $metaIndikatorQuery)->whereIn('status_kominfo', StatusKominfo::completedValues())->count();
        $metaIndikatorDraft = (clone $metaIndikatorQuery)->where('status_kominfo', StatusKominfo::DRAFT->value)->count();

        $metaTotalDone = $metaKegiatanDone + $metaVariabelDone + $metaIndikatorDone;
        $metaTotalDraft = $metaKegiatanDraft + $metaVariabelDraft + $metaIndikatorDraft;
        $metaTotalTarget = $totalKegiatan * 3;
        $metaTotalBelum = max(0, $metaTotalTarget - $metaTotalDone - $metaTotalDraft);

        // Aliran Data
        $aliranTotal = \Illuminate\Support\Facades\Cache::get('aliran_stats_total', 0);
        $aliranTayang = \Illuminate\Support\Facades\Cache::get('aliran_stats_tayang', 0);
        $aliranBelum = \Illuminate\Support\Facades\Cache::get('aliran_stats_belum', 0);

        // Donut percentages
        $pctRomantik = $totalKegiatan > 0 ? round($romantikDiajukan / $totalKegiatan * 100) : 0;
        $pctMetadata = $metaTotalTarget > 0 ? round($metaTotalDone / $metaTotalTarget * 100) : 0;
        $pctAliran = $aliranTotal > 0 ? round($aliranTayang / $aliranTotal * 100) : 0;

        // Tingkat Respon
        $tingkatRespon = $romantikTotal > 0 ? round(($romantikDiajukan / $romantikTotal) * 100) : 0;

        return [
            'tahun' => $tahun,
            'totalKegiatan' => $totalKegiatan,
            'totalDinas' => $totalDinas,
            'tingkatRespon' => $tingkatRespon,
            'romantikDiajukan' => $romantikDiajukan,
            'romantikBelum' => $romantikBelum,
            'metaKegiatanDone' => $metaTotalDone,
            'metaKegiatanDraft' => $metaTotalDraft,
            'metaKegiatanTotal' => $metaTotalTarget,
            'metaVariabelDone' => $metaVariabelDone,
            'metaVariabelTotal' => $totalKegiatan,
            'metaIndikatorDone' => $metaIndikatorDone,
            'metaIndikatorTotal' => $totalKegiatan,
            'aliranTayang' => $aliranTayang,
            'aliranBelum' => $aliranBelum,
            'aliranTotal' => $aliranTotal,
            'pctRomantik' => $pctRomantik,
            'pctMetadata' => $pctMetadata,
            'pctAliran' => $pctAliran,
        ];
    }

    /**
     * Ambil data chart per jenis kegiatan (pie chart).
     *
     * @return array Berisi labels, values, colors
     */
    public function getChartData(int $tahun): array
    {
        $jenisLabels = [];
        $jenisValues = [];
        $jenisColors = [];

        foreach (JenisKegiatan::cases() as $jenis) {
            $jenisLabels[] = $jenis->label();
            $jenisValues[] = KegiatanStatistik::where('tahun', $tahun)->where('jenis', $jenis->value)->count();
            $jenisColors[] = match ($jenis) {
                JenisKegiatan::SURVEI => '#002B6A',
                JenisKegiatan::PENDATAAN_LENGKAP => '#00B69B',
                JenisKegiatan::KOMPROMIN => '#EB891B',
            };
        }

        return [
            'jenisLabels' => $jenisLabels,
            'jenisValues' => $jenisValues,
            'jenisColors' => $jenisColors,
        ];
    }

    /**
     * Ambil data tren bulanan untuk hero chart.
     *
     * @return array Berisi heroMonthlyRomantik, heroMonthlyMetadata, heroMonthlyAliran
     */
    public function getMonthlyTrends(int $tahun): array
    {
        $getMonthly = function ($query) use ($tahun) {
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

        return [
            'heroMonthlyRomantik' => $getMonthly(Romantik::whereIn('status_dinas', StatusDinas::submittedValues())),
            'heroMonthlyMetadata' => $getMonthly(Metadata::where('jenis', JenisMetadata::KEGIATAN->value)->whereIn('status_kominfo', StatusKominfo::completedValues())),
            'heroMonthlyAliran' => collect(),
        ];
    }

    /**
     * Ambil statistik kehadiran pembinaan.
     *
     * @return array Berisi totalSesiPembinaan, totalKehadiran, maxKehadiran, pctKehadiran
     */
    public function getPembinaanStats(int $tahun): array
    {
        $totalDinas = Dinas::count();
        $totalSesiPembinaan = Pembinaan::whereYear('tanggal', $tahun)->count();
        $totalKehadiran = PresensiPembinaan::whereHas('pembinaan', function ($q) use ($tahun) {
            $q->whereYear('tanggal', $tahun);
        })->where('hadir', true)->count();
        $maxKehadiran = $totalSesiPembinaan * $totalDinas;
        $pctKehadiran = $maxKehadiran > 0 ? round(($totalKehadiran / $maxKehadiran) * 100) : 0;

        return [
            'totalSesiPembinaan' => $totalSesiPembinaan,
            'totalKehadiran' => $totalKehadiran,
            'maxKehadiran' => $maxKehadiran,
            'pctKehadiran' => $pctKehadiran,
        ];
    }

    /**
     * Ambil tahun default (tahun terbaru yang punya data).
     */
    public function getDefaultTahun(): int
    {
        return KegiatanStatistik::max('tahun') ?? (int) date('Y');
    }
}
