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

    #[Url(except: 'terbaru')]
    public $sortBy = 'terbaru';

    #[Url(except: '')]
    public $search = '';

    public $perPage = 10;
    public $isLoading = false;

    public function updatedDinasFilter()
    {
        $this->resetPage();
    }

    public function updatedSortBy()
    {
        $this->resetPage();
    }

    public function updatedSearch()
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

        // Filter pencarian jika diisi
        if ($this->search && trim($this->search) !== '') {
            $keyword = strtolower(trim($this->search));
            $filteredData = [];
            foreach ($allData as $item) {
                $nama = strtolower($item['nama_data'] ?? '');
                $idData = strtolower($item['id_data'] ?? '');
                $cakupan = strtolower($item['cakupan'] ?? '');
                $dinas = strtolower($item['dinas_nama'] ?? '');
                if (str_contains($nama, $keyword) || str_contains($idData, $keyword) || str_contains($cakupan, $keyword) || str_contains($dinas, $keyword)) {
                    $filteredData[] = $item;
                }
            }
            $allData = $filteredData;
        }

        // Urutkan data berdasarkan opsi sortBy (default: terbaru)
        if ($this->sortBy === 'terbaru') {
            usort($allData, function ($a, $b) {
                $minA = parse_relative_time_to_minutes($a['pemutahiran'] ?? null);
                $minB = parse_relative_time_to_minutes($b['pemutahiran'] ?? null);
                if ($minA === $minB) {
                    return strcmp($a['id_data'] ?? '', $b['id_data'] ?? '');
                }
                return $minA <=> $minB;
            });
        } elseif ($this->sortBy === 'terlama') {
            usort($allData, function ($a, $b) {
                $minA = parse_relative_time_to_minutes($a['pemutahiran'] ?? null);
                $minB = parse_relative_time_to_minutes($b['pemutahiran'] ?? null);
                if ($minA === $minB) {
                    return strcmp($b['id_data'] ?? '', $a['id_data'] ?? '');
                }
                return $minB <=> $minA;
            });
        } elseif ($this->sortBy === 'id_asc') {
            usort($allData, fn($a, $b) => strcmp($a['id_data'] ?? '', $b['id_data'] ?? ''));
        } elseif ($this->sortBy === 'id_desc') {
            usort($allData, fn($a, $b) => strcmp($b['id_data'] ?? '', $a['id_data'] ?? ''));
        } elseif ($this->sortBy === 'nama_asc') {
            usort($allData, fn($a, $b) => strcmp($a['nama_data'] ?? '', $b['nama_data'] ?? ''));
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
            'dinasList' => $dinasListOptions,
            'totalFiltered' => $total,
        ]);
    }
}
