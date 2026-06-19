<?php

namespace App\Exports;

use App\Models\Monev;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class MonevExport implements FromView, ShouldAutoSize
{
    protected int $tahun;
    protected ?int $dinasId;
    protected ?string $status;
    protected ?string $search;

    public function __construct(int $tahun, ?int $dinasId = null, ?string $status = null, ?string $search = null)
    {
        $this->tahun = $tahun;
        $this->dinasId = $dinasId;
        $this->status = $status;
        $this->search = $search;
    }

    public function view(): View
    {
        $monevQuery = Monev::with('kegiatanStatistik.dinas')->where('tahun', $this->tahun);

        if ($this->dinasId) {
            $monevQuery->whereHas('kegiatanStatistik', function ($q) {
                $q->where('dinas_id', $this->dinasId);
            });
        }
        if ($this->status) {
            $monevQuery->where('status', $this->status);
        }
        if ($this->search) {
            $escapedSearch = str_replace(['%', '_'], ['\\%', '\\_'], $this->search);
            $monevQuery->whereHas('kegiatanStatistik', function ($q) use ($escapedSearch) {
                $q->where('nama', 'like', '%' . $escapedSearch . '%');
            });
        }

        $monevItems = $monevQuery->get();

        return view('exports.monev_excel', [
            'monevItems' => $monevItems,
            'tahun' => $this->tahun,
        ]);
    }
}
