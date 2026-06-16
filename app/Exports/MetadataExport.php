<?php

namespace App\Exports;

use App\Models\Metadata;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MetadataExport implements FromView
{
    protected $tahun;
    protected $dinasId;
    protected $jenis;
    protected $search;

    public function __construct($tahun, $dinasId = null, $jenis = null, $search = null)
    {
        $this->tahun = $tahun;
        $this->dinasId = $dinasId;
        $this->jenis = $jenis;
        $this->search = $search;
    }

    public function view(): View
    {
        $query = Metadata::with(['kegiatanStatistik.dinas'])
            ->where('tahun', $this->tahun);

        if ($this->dinasId) {
            $query->whereHas('kegiatanStatistik', function ($q) {
                $q->where('dinas_id', $this->dinasId);
            });
        }

        if ($this->jenis) {
            $query->where('jenis', $this->jenis);
        }

        if ($this->search) {
            $query->whereHas('kegiatanStatistik', function ($q) {
                $q->where('nama', 'like', '%' . $this->search . '%')
                  ->orWhereHas('dinas', function ($q2) {
                      $q2->where('nama', 'like', '%' . $this->search . '%');
                  });
            });
        }

        return view('exports.metadata_excel', [
            'metadataItems' => $query->get(),
            'tahun' => $this->tahun
        ]);
    }
}
