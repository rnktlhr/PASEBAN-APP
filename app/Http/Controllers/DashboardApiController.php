<?php

namespace App\Http\Controllers;

use App\Enums\JenisKegiatan;
use App\Enums\JenisMetadata;
use App\Enums\StatusDinas;
use App\Enums\StatusKominfo;
use App\Models\AliranData;
use App\Models\KegiatanStatistik;
use App\Models\Metadata;
use App\Models\Romantik;
use App\Services\DashboardService;
use Illuminate\Http\Request;

class DashboardApiController extends Controller
{
    public function __construct(
        protected DashboardService $dashboardService
    ) {}

    public function getChartData(Request $request)
    {
        $request->validate([
            'year' => 'nullable|integer|min:2020|max:2099',
            'type' => 'required|string|in:kegiatan,romantik,metadata,aliran',
        ]);

        $year = (int) $request->input('year', $this->dashboardService->getDefaultTahun());
        $type = $request->input('type');

        if ($type === 'kegiatan') {
            // Reuse DashboardService — menghilangkan duplikasi logic
            $chartData = $this->dashboardService->getChartData($year);
            return response()->json([
                'labels' => $chartData['jenisLabels'],
                'data' => $chartData['jenisValues'],
                'colors' => $chartData['jenisColors'],
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
        $request->validate([
            'year' => 'nullable|integer|min:2020|max:2099',
            'type' => 'required|string|in:kegiatan,romantik,metadata,aliran',
            'status' => 'required|string|max:50',
        ]);

        $defaultYear = KegiatanStatistik::max('tahun') ?? (int) date('Y');
        $year = (int) $request->input('year', $defaultYear);
        $type = $request->input('type');
        $status = $request->input('status');

        $items = [];
        $title = "Rincian Data";

        if ($type === 'kegiatan') {
            $jenisCase = JenisKegiatan::tryFrom($status);
            $jenisLabel = $jenisCase ? $jenisCase->label() : ucfirst($status);

            $title = "Daftar Kegiatan Statistik ($jenisLabel - $year)";
            $items = KegiatanStatistik::with('dinas')->where('tahun', $year)->where('jenis', $status)->get()->map(function($item) {
                return [
                    'kegiatan' => $item->nama,
                    'dinas' => $item->dinas->nama ?? '-',
                    'status_label' => $item->jenis instanceof JenisKegiatan ? $item->jenis->label() : ucfirst($item->jenis),
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
                $enum = StatusDinas::tryFrom($item->status_dinas);
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
                $enum = StatusKominfo::tryFrom($item->status_kominfo);
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
                $color = $item->sudah_tayang ? '#002B6A' : '#EB891B';
                $bg = $item->sudah_tayang ? '#eef2f6' : 'rgba(235,137,27,.1)';
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
