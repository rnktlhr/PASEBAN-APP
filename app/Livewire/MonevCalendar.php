<?php

namespace App\Livewire;

use App\Models\Dinas;
use App\Models\Monev;
use App\Models\KegiatanStatistik;
use App\Enums\StatusMonev;
use Livewire\Component;
use Livewire\Attributes\Url;

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

    #[Url]
    public $jenis_laporan = 'kegiatan';

    public function mount($tahunAwal)
    {
        $this->tahun = $this->tahun ?: $tahunAwal;
    }

    public function decrementTahun()
    {
        $this->tahun = (int) $this->tahun - 1;
    }

    public function incrementTahun()
    {
        $this->tahun = (int) $this->tahun + 1;
    }

    public function getMonevDataProperty()
    {
        $monevQuery = Monev::with('kegiatanStatistik.dinas')
            ->where('tahun', (int) $this->tahun);

        if (!empty($this->dinas_id)) {
            $dinasId = (int) $this->dinas_id;
            $monevQuery->whereHas('kegiatanStatistik', function ($q) use ($dinasId) {
                $q->where('dinas_id', $dinasId);
            });
        }

        if (!empty($this->status)) {
            $monevQuery->where('status', $this->status);
        }

        if (!empty($this->search)) {
            $escapedSearch = str_replace(['%', '_'], ['\%', '\_'], $this->search);
            $monevQuery->whereHas('kegiatanStatistik', function ($q) use ($escapedSearch) {
                $q->where('nama', 'like', '%' . $escapedSearch . '%');
            });
        }

        $items = $monevQuery->get();

        $tepatWaktu = $items->where('status', StatusMonev::TEPAT_WAKTU)->count();
        $terlambat = $items->where('status', StatusMonev::TERLAMBAT)->count();
        $total = $items->count();
        $pct = $total > 0 ? round(($tepatWaktu / $total) * 100) : 0;

        $totalKegiatan = KegiatanStatistik::where('tahun', (int) $this->tahun)->count();

        return [
            'items' => $items,
            'tepatWaktu' => $tepatWaktu,
            'terlambat' => $terlambat,
            'total' => $total,
            'pct' => $pct,
            'totalKegiatan' => $totalKegiatan,
        ];
    }

    public function render()
    {
        $data = $this->monevData;

        // Provide Dinas list to view instead of querying in Blade template
        $dinasList = Dinas::orderBy('singkatan')->get(['id', 'singkatan']);

        return view('livewire.monev-calendar', [
            'monevItems' => $data['items'],
            'monevTepatWaktu' => $data['tepatWaktu'],
            'monevTerlambat' => $data['terlambat'],
            'pctKeberhasilan' => $data['pct'],
            'totalKegiatan' => $data['totalKegiatan'],
            'dinasList' => $dinasList,
        ]);
    }
}
