<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use App\Models\AliranData;
use App\Models\Dinas;

class PublicAliranDataTable extends Component
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
        $query = AliranData::with('kegiatanStatistik.dinas')->where('tahun', $this->tahun);

        if (!empty($this->dinasFilter)) {
            $query->whereHas('kegiatanStatistik', function($q) {
                $q->where('dinas_id', $this->dinasFilter);
            });
        }
        if ($this->status !== '') {
            $query->where('sudah_tayang', $this->status == '1');
        }
        if (!empty($this->search)) {
            $search = str_replace(['%', '_'], ['\\%', '\\_'], $this->search);
            $query->where(function($q) use ($search) {
                $q->where('nama_data', 'like', "%{$search}%")
                  ->orWhereHas('kegiatanStatistik', function($q2) use ($search) {
                      $q2->where('nama', 'like', "%{$search}%")
                         ->orWhereHas('dinas', function($q3) use ($search) {
                             $q3->where('nama', 'like', "%{$search}%")->orWhere('singkatan', 'like', "%{$search}%");
                         });
                  });
            });
        }

        $aliranData = $query->paginate(10);
        $dinasList = Dinas::orderBy('nama')->get();

        return view('livewire.public-aliran-data-table', compact('aliranData', 'dinasList'));
    }
}
