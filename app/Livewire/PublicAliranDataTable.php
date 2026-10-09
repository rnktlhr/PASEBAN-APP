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
    public $isLoading = false;

    public function updatedDinasFilter()
    {
        $this->resetPage();
    }

    public function updatedPerPage()
    {
        $this->resetPage();
    }

    public function mount()
    {
    }

    public function loadInitialData()
    {
        // Not needed anymore since render does everything instantly, but kept for interface
    }

    public function render()
    {
        // Ambil daftar instansi dari API Sedata Sebantul
        $dinasListOptions = Cache::remember('api_instansi_list', 3600, function () {
            try {
                $response = Http::withoutVerifying()->timeout(10)->get(config('services.bantul.api_url') . '/instansi');
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

        // Baca Data Lokal JSON
        $allData = [];
        $jsonPath = storage_path('app/aliran_data_all.json');
        if (file_exists($jsonPath)) {
            $allData = json_decode(file_get_contents($jsonPath), true) ?? [];
        }

        // Filter jika dinas dipilih
        if ($this->dinasFilter && $this->dinasFilter !== '') {
            $targetDinasName = $dinasListOptions[$this->dinasFilter] ?? '';
            
            if ($targetDinasName) {
                $filteredData = [];
                foreach ($allData as $item) {
                    if (isset($item['dinas_nama']) && $item['dinas_nama'] === $targetDinasName) {
                        $filteredData[] = $item;
                    }
                }
                $allData = $filteredData;
            }
        }

        // Array Pagination
        $page = $this->getPage();
        $total = count($allData);
        $items = array_slice($allData, ($page - 1) * $this->perPage, $this->perPage);
        
        $paginatedData = new LengthAwarePaginator($items, $total, $this->perPage, $page, [
            'path' => request()->url(),
            'query' => request()->query()
        ]);

        return view('livewire.public-aliran-data-table', [
            'paginatedData' => $paginatedData,
            'dinasList' => $dinasListOptions
        ]);
    }
}
