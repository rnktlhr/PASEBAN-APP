<?php

namespace App\Http\Controllers;

use App\Enums\JenisMetadata;
use App\Enums\StatusDinas;
use App\Enums\StatusKominfo;
use App\Models\AliranData;
use App\Models\KegiatanStatistik;
use App\Models\Metadata;
use App\Models\Romantik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardApiController extends Controller
{
    public function getChartData(Request $request)
    {
        $year = (int) $request->input('year', date('Y'));
        $type = $request->input('type');

        if ($type === 'kegiatan') {
            $chartData = KegiatanStatistik::select(DB::raw('MONTH(created_at) as bulan'), DB::raw('COUNT(*) as total'))
                ->where('tahun', $year)
                ->groupBy('bulan')
                ->pluck('total', 'bulan');

            $chartYears = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'];
            $chartValues = [];
            for ($m = 1; $m <= 12; $m++) {
                $chartValues[] = $chartData->get($m, 0);
            }

            return response()->json([
                'categories' => $chartYears,
                'data' => $chartValues,
            ]);
        }

        $totalKegiatan = KegiatanStatistik::where('tahun', $year)->count();

        if ($type === 'romantik') {
            $done = Romantik::where('tahun', $year)->whereIn('status_dinas', StatusDinas::submittedValues())->count();
            $belum = Romantik::where('tahun', $year)->where('status_dinas', StatusDinas::BELUM_DIAJUKAN->value)->count();
            $pct = $totalKegiatan > 0 ? round($done / $totalKegiatan * 100) : 0;
            return response()->json(['done' => $done, 'belum' => $belum, 'pct' => $pct]);
        }

        if ($type === 'metadata') {
            $meta = Metadata::where('tahun', $year)->where('jenis', JenisMetadata::KEGIATAN->value);
            $total = $meta->count();
            $done = (clone $meta)->whereIn('status_kominfo', StatusKominfo::completedValues())->count();
            $draft = (clone $meta)->where('status_kominfo', StatusKominfo::DRAFT->value)->count();
            $belum = $total - $done - $draft;
            $pct = $total > 0 ? round($done / $total * 100) : 0;
            return response()->json(['done' => $done, 'draft' => $draft, 'belum' => $belum, 'pct' => $pct]);
        }

        if ($type === 'aliran') {
            $done = AliranData::where('tahun', $year)->where('sudah_tayang', true)->count();
            $belum = AliranData::where('tahun', $year)->where('sudah_tayang', false)->count();
            $total = $done + $belum;
            $pct = $total > 0 ? round($done / $total * 100) : 0;
            return response()->json(['done' => $done, 'belum' => $belum, 'pct' => $pct]);
        }

        return response()->json(['error' => 'Invalid type'], 400);
    }

    public function getChartDetails(Request $request)
    {
        $year = (int) $request->input('year', date('Y'));
        $type = $request->input('type'); // romantik, metadata, aliran, kegiatan
        $status = $request->input('status'); // done, belum, or year (for kegiatan)

        $items = [];
        $title = "Rincian Data";

        if ($type === 'kegiatan') {
            $months = ['Jan' => 1, 'Feb' => 2, 'Mar' => 3, 'Apr' => 4, 'Mei' => 5, 'Jun' => 6, 'Jul' => 7, 'Agt' => 8, 'Sep' => 9, 'Okt' => 10, 'Nov' => 11, 'Des' => 12];
            $monthNames = array_flip($months);
            $monthNum = $months[$status] ?? 1;
            $fullMonthName = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'][$monthNum - 1];

            $title = "Daftar Kegiatan Statistik ($fullMonthName $year)";
            $items = KegiatanStatistik::with('dinas')->where('tahun', $year)->whereMonth('created_at', $monthNum)->get()->map(function($item) {
                return [
                    'kegiatan' => $item->nama,
                    'dinas' => $item->dinas->nama ?? '-',
                    'status_label' => 'Terdaftar',
                    'status_color' => 'var(--navy)',
                    'status_bg' => '#eef2f6'
                ];
            });
        } elseif ($type === 'romantik') {
            $title = "Rincian Romantik ($year) - " . ($status === 'done' ? 'Sudah Diajukan' : 'Belum Diajukan');
            $query = Romantik::with('kegiatanStatistik.dinas')->where('tahun', $year);
            if ($status === 'done') {
                $query->whereIn('status_dinas', StatusDinas::submittedValues());
            } else {
                $query->where('status_dinas', StatusDinas::BELUM_DIAJUKAN->value);
            }
            $items = $query->get()->map(function($item) {
                $enum = \App\Enums\StatusDinas::tryFrom($item->status_dinas);
                return [
                    'kegiatan' => $item->kegiatanStatistik->nama ?? '-',
                    'dinas' => $item->kegiatanStatistik->dinas->nama ?? '-',
                    'status_label' => $enum ? $enum->label() : '-',
                    'status_color' => $enum ? $enum->cssColor() : 'var(--muted)',
                    'status_bg' => $enum ? $enum->cssBgColor() : 'var(--line)',
                ];
            });
        } elseif ($type === 'metadata') {
            if ($status === 'done') {
                $title = "Rincian Metadata Kegiatan ($year) - Sudah Menyusun";
            } elseif ($status === 'draft') {
                $title = "Rincian Metadata Kegiatan ($year) - Draft";
            } else {
                $title = "Rincian Metadata Kegiatan ($year) - Belum Menyusun";
            }

            $query = Metadata::with('kegiatanStatistik.dinas')->where('tahun', $year)->where('jenis', JenisMetadata::KEGIATAN->value);
            if ($status === 'done') {
                $query->whereIn('status_kominfo', StatusKominfo::completedValues());
            } elseif ($status === 'draft') {
                $query->where('status_kominfo', StatusKominfo::DRAFT->value);
            } else {
                $query->whereNotIn('status_kominfo', StatusKominfo::completedValues())
                      ->where('status_kominfo', '!=', StatusKominfo::DRAFT->value);
            }
            $items = $query->get()->map(function($item) {
                $enum = \App\Enums\StatusKominfo::tryFrom($item->status_kominfo);
                return [
                    'kegiatan' => $item->kegiatanStatistik->nama ?? '-',
                    'dinas' => $item->kegiatanStatistik->dinas->nama ?? '-',
                    'status_label' => $enum ? $enum->label() : '-',
                    'status_color' => $enum ? $enum->cssColor() : 'var(--muted)',
                    'status_bg' => $enum ? $enum->cssBgColor() : 'var(--line)',
                ];
            });
        } elseif ($type === 'aliran') {
            $title = "Rincian Aliran Data ($year) - " . ($status === 'done' ? 'Sudah Tayang' : 'Belum Tayang');
            $query = AliranData::with('kegiatanStatistik.dinas')->where('tahun', $year);
            if ($status === 'done') {
                $query->where('sudah_tayang', true);
            } else {
                $query->where('sudah_tayang', false);
            }
            $items = $query->get()->map(function($item) {
                $label = $item->sudah_tayang ? 'Sudah Tayang' : 'Belum Tayang';
                $color = $item->sudah_tayang ? '#05529F' : '#F58220';
                $bg = $item->sudah_tayang ? '#eef2f6' : 'rgba(245,130,32,.1)';
                return [
                    'kegiatan' => $item->kegiatanStatistik->nama ?? '-',
                    'dinas' => $item->kegiatanStatistik->dinas->nama ?? '-',
                    'status_label' => $label,
                    'status_color' => $color,
                    'status_bg' => $bg,
                ];
            });
        }

        return response()->json([
            'title' => $title,
            'items' => $items
        ]);
    }
}
