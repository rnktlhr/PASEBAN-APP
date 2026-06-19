<?php

namespace App\Exports;

use App\Models\KegiatanStatistik;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class KegiatanStatistikExport implements FromView
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
        $query = KegiatanStatistik::with('dinas')
            ->where('tahun', $this->tahun);

        if ($this->dinasId) {
            $query->where('dinas_id', $this->dinasId);
        }

        if ($this->jenis) {
            $query->where('jenis', $this->jenis);
        }

        if ($this->search) {
            $escapedSearch = str_replace(['%', '_'], ['\\%', '\\_'], $this->search);
            $query->where(function ($q) use ($escapedSearch) {
                $q->where('nama', 'like', '%' . $escapedSearch . '%')
                  ->orWhereHas('dinas', function ($q2) use ($escapedSearch) {
                      $q2->where('nama', 'like', '%' . $escapedSearch . '%')
                         ->orWhere('singkatan', 'like', '%' . $escapedSearch . '%');
                  });
            });
        }

        return view('exports.kegiatan_statistik_excel', [
            'kegiatanItems' => $query->get(),
            'tahun' => $this->tahun
        ]);
    }
}
