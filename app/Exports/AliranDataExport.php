<?php

namespace App\Exports;

use App\Models\AliranData;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AliranDataExport implements FromView
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
        $query = AliranData::with(['kegiatanStatistik.dinas'])
            ->where('tahun', $this->tahun);

        if ($this->dinasId) {
            $query->whereHas('kegiatanStatistik', function ($q) {
                $q->where('dinas_id', $this->dinasId);
            });
        }

        if ($this->status !== null && $this->status !== '') {
            $query->where('sudah_tayang', $this->status == '1');
        }

        if ($this->search) {
            $escapedSearch = str_replace(['%', '_'], ['\\%', '\\_'], $this->search);
            $query->whereHas('kegiatanStatistik', function ($q) use ($escapedSearch) {
                $q->where('nama', 'like', '%' . $escapedSearch . '%')
                  ->orWhereHas('dinas', function ($q2) use ($escapedSearch) {
                      $q2->where('nama', 'like', '%' . $escapedSearch . '%');
                  });
            });
        }

        return view('exports.aliran_data_excel', [
            'aliranDataItems' => $query->get(),
            'tahun' => $this->tahun
        ]);
    }
}
