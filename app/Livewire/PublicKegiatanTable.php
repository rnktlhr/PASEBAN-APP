<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use App\Models\KegiatanStatistik;
use App\Models\Dinas;

class PublicKegiatanTable extends Component
{
    use WithPagination;

    public $tahun;

    #[Url(except: '')]
    public $jenis = '';

    #[Url(except: '')]
    public $dinasFilter = '';

    #[Url(except: '')]
    public $search = '';

    public function updatingJenis()
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
        $query = KegiatanStatistik::with('dinas')->where('tahun', $this->tahun);
        
        if (!empty($this->dinasFilter)) {
            $query->where('dinas_id', $this->dinasFilter);
        }
        if (!empty($this->jenis)) {
            $query->where('jenis', $this->jenis);
        }
        if (!empty($this->search)) {
            $search = str_replace(['%', '_'], ['\\%', '\\_'], $this->search);
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhereHas('dinas', function($q2) use ($search) {
                      $q2->where('nama', 'like', "%{$search}%")->orWhere('singkatan', 'like', "%{$search}%");
                  });
            });
        }

        $kegiatan = $query->orderBy('dinas_id')->paginate(10);
        $dinasList = Dinas::orderBy('nama')->get();

        return view('livewire.public-kegiatan-table', compact('kegiatan', 'dinasList'));
    }
}
