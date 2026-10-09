<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;

class PublicAliranDataTable extends Component
{
    use WithPagination;

    public $tahun;

    #[Url(except: '')]
    public $dinasFilter = '';

    public $perPage = 10;
    public $indikatorData = [];
    public $isLoading = false;

    public function updatedDinasFilter()
    {
        $this->resetPage();
        $this->fetchData();
    }

    public function updatedPerPage()
    {
        $this->resetPage();
    }

    public function mount()
    {
        // Sengaja dikosongkan agar loading halaman pertama tidak terblokir (ngelag)
    }

    public function loadInitialData()
    {
        $this->fetchData();
    }

    public function fetchData()
    {
        $this->indikatorData = [];
        $this->isLoading = true;

        // Tampilkan semua data jika filter kosong
        if (!$this->dinasFilter) {
            $jsonPath = storage_path('app/aliran_data_all.json');
            if (file_exists($jsonPath)) {
                $this->indikatorData = json_decode(file_get_contents($jsonPath), true) ?? [];
            }
            $this->isLoading = false;
            return;
        }

        // Tampilkan spesifik dinas dari API langsung

        try {
            $page = 1;
            $lastPage = 1;
            
            do {
                $response = Http::withoutVerifying()->timeout(15)->get(config('services.bantul.api_url') . '/indikator', [
                    'instansi_code' => $this->dinasFilter,
                    'page' => $page,
                ]);

                if ($response->successful()) {
                    $data = $response->json('data.result');
                    if (is_array($data)) {
                        $this->indikatorData = array_merge($this->indikatorData, $data);
                    }
                    
                    $lastPage = $response->json('data.meta.lastPage') ?? 1;
                    $page++;
                } else {
                    \Illuminate\Support\Facades\Log::error('API Indikator Error', ['status' => $response->status(), 'body' => $response->body()]);
                    break;
                }
            } while ($page <= $lastPage);

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('API Indikator Exception', ['msg' => $e->getMessage()]);
        }

        $this->isLoading = false;
    }

    public function render()
    {
        // Ambil daftar instansi dari API Sedata Sebantul
        $dinasList = Cache::remember('api_instansi_list', 3600, function () {
            try {
                $response = Http::timeout(10)->get(config('services.bantul.api_url') . '/instansi');
                if ($response->successful()) {
                    $options = collect($response->json('data.result'))
                        ->pluck('instansi_name', 'instansi_cd')
                        ->toArray();
                    asort($options);
                    return $options;
                }
            } catch (\Exception $e) {
                // silently handle
            }
            return [];
        });

        // Array Pagination
        $page = $this->getPage();
        $total = count($this->indikatorData);
        $items = array_slice($this->indikatorData, ($page - 1) * $this->perPage, $this->perPage);
        
        $paginatedData = new LengthAwarePaginator($items, $total, $this->perPage, $page, [
            'path' => request()->url(),
            'query' => request()->query()
        ]);

        return view('livewire.public-aliran-data-table', compact('dinasList', 'paginatedData'));
    }
}
