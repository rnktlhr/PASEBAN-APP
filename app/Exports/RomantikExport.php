<?php

namespace App\Exports;

use App\Models\Romantik;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RomantikExport implements FromView
{
    protected $tahun;
    protected $dinasId;
    protected $status;
    protected $search;

    public function __construct($tahun, $dinasId = null, $status = null, $search = null)
    {
        $this->tahun = $tahun;
        $this->dinasId = $dinasId;
        $this->status = $status;
        $this->search = $search;
    }

    public function view(): View
    {
        $query = Romantik::with(['kegiatanStatistik.dinas'])
            ->where('tahun', $this->tahun);

        if ($this->dinasId) {
            $query->whereHas('kegiatanStatistik', function ($q) {
                $q->where('dinas_id', $this->dinasId);
            });
        }

        if ($this->status) {
            if ($this->status === 'done') {
                $query->whereIn('status_dinas', \App\Enums\StatusDinas::submittedValues());
            } else {
                $query->whereNotIn('status_dinas', \App\Enums\StatusDinas::submittedValues());
            }
        }

        if ($this->search) {
            $query->whereHas('kegiatanStatistik', function ($q) {
                $q->where('nama', 'like', '%' . $this->search . '%')
                  ->orWhereHas('dinas', function ($q2) {
                      $q2->where('nama', 'like', '%' . $this->search . '%');
                  });
            });
        }

        return view('exports.romantik_excel', [
            'romantikItems' => $query->get(),
            'tahun' => $this->tahun
        ]);
    }
}
