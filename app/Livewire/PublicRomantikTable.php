<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use App\Models\Romantik;
use App\Models\Dinas;

class PublicRomantikTable extends Component
{
    use WithPagination;

    public $tahun;

    #[Url(except: '')]
    public $status = '';

    #[Url(except: '')]
    public $dinasFilter = '';

    #[Url(except: '')]
    public $search = '';

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function updatingDinasFilter()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Romantik::with('kegiatanStatistik.dinas')->where('tahun', $this->tahun);

        if (!empty($this->dinasFilter)) {
            $query->whereHas('kegiatanStatistik', function($q) {
                $q->where('dinas_id', $this->dinasFilter);
            });
        }
        if ($this->status === 'done') {
            $query->whereNotNull('status_bps')->where('status_bps', '!=', 'belum_diajukan');
        } elseif ($this->status === 'belum') {
            $query->where(function($q) {
                $q->whereNull('status_bps')->orWhere('status_bps', 'belum_diajukan');
            });
        }
        if (!empty($this->search)) {
            $search = str_replace(['%', '_'], ['\\%', '\\_'], $this->search);
            $query->whereHas('kegiatanStatistik', function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhereHas('dinas', function($q2) use ($search) {
                      $q2->where('nama', 'like', "%{$search}%")->orWhere('singkatan', 'like', "%{$search}%");
                  });
            });
        }

        $romantik = $query->paginate(10);
        $dinasList = Dinas::orderBy('nama')->get();

        return view('livewire.public-romantik-table', compact('romantik', 'dinasList'));
    }
}
