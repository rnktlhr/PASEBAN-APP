<?php

namespace App\Exports;

use App\Models\Monev;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class MonevExport implements FromView, ShouldAutoSize
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        $tahun = (int) $this->request->input('tahun', date('Y'));
        $monevQuery = Monev::with('kegiatanStatistik.dinas')->where('tahun', $tahun);
        
        if ($this->request->filled('dinas_id')) {
            $monevQuery->whereHas('kegiatanStatistik', function($q) {
                $q->where('dinas_id', $this->request->dinas_id);
            });
        }
        if ($this->request->filled('status')) {
            $monevQuery->where('status', $this->request->status);
        }
        if ($this->request->filled('search')) {
            $monevQuery->whereHas('kegiatanStatistik', function($q) {
                $q->where('nama', 'like', '%' . $this->request->search . '%');
            });
        }
        
        $monevItems = $monevQuery->get();

        return view('exports.monev_pdf', [
            'monevItems' => $monevItems,
            'tahun' => $tahun
        ]);
    }
}
