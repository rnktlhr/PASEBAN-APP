<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Url;
use App\Models\Monev;
use App\Models\KegiatanStatistik;

class MonevCalendar extends Component
{
    #[Url]
    public $tahun;

    #[Url]
    public $dinas_id = '';

    #[Url]
    public $status = '';

    #[Url(except: '')]
    public $search = '';

    public function mount($tahunAwal)
    {
        $this->tahun = $this->tahun ?: $tahunAwal;
    }

    public function decrementTahun()
    {
        $this->tahun = (int)$this->tahun - 1;
    }

    public function incrementTahun()
    {
        $this->tahun = (int)$this->tahun + 1;
    }

    public function getMonevDataProperty()
    {
        $monevQuery = Monev::with('kegiatanStatistik.dinas')
            ->where('tahun', (int) $this->tahun);

        if (!empty($this->dinas_id)) {
            $monevQuery->whereHas('kegiatanStatistik', function($q) {
                $q->where('dinas_id', $this->dinas_id);
            });
        }

        if (!empty($this->status)) {
            $monevQuery->where('status', $this->status);
        }

        if (!empty($this->search)) {
            $monevQuery->whereHas('kegiatanStatistik', function($q) {
                $q->where('nama', 'like', '%' . $this->search . '%');
            });
        }

        $items = $monevQuery->get();

        $tepatWaktu = $items->where('status', Monev::STATUS_TEPAT_WAKTU)->count();
        $terlambat = $items->where('status', Monev::STATUS_TERLAMBAT)->count();
        $total = $items->count();
        $pct = $total > 0 ? round(($tepatWaktu / $total) * 100) : 0;
        
        $totalKegiatan = KegiatanStatistik::where('tahun', (int) $this->tahun)->count();

        return [
            'items' => $items,
            'tepatWaktu' => $tepatWaktu,
            'terlambat' => $terlambat,
            'total' => $total,
            'pct' => $pct,
            'totalKegiatan' => $totalKegiatan
        ];
    }

    public function render()
    {
        $data = $this->monevData;

        return view('livewire.monev-calendar', [
            'monevItems' => $data['items'],
            'monevTepatWaktu' => $data['tepatWaktu'],
            'monevTerlambat' => $data['terlambat'],
            'pctKeberhasilan' => $data['pct'],
            'totalKegiatan' => $data['totalKegiatan'],
        ]);
    }
}
