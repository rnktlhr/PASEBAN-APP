<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class PublicAliranDataTable extends Component
{
    public $tahun;

    #[Url(except: '')]
    public $dinasFilter = '';

    public $indikatorData = [];
    public $isLoading = false;

    public function updatedDinasFilter()
    {
        $this->fetchData();
    }

    public function mount()
    {
        if ($this->dinasFilter) {
            $this->fetchData();
        }
    }

    public function fetchData()
    {
        $this->indikatorData = [];
        if (!$this->dinasFilter) {
            return;
        }

        $this->isLoading = true;

        try {
            $response = Http::timeout(15)->withHeaders([
                'X-instansi-Code' => $this->dinasFilter,
            ])->get('https://data.bantulkab.go.id/api/indikator');

            if ($response->successful()) {
                $data = $response->json('data.result');
                if (is_array($data)) {
                    $this->indikatorData = $data;
                }
            }
        } catch (\Exception $e) {
            // handle error silently
        }

        $this->isLoading = false;
    }

    public function render()
    {
        // Ambil daftar instansi dari API Sedata Sebantul
        $dinasList = Cache::remember('api_instansi_list', 3600, function () {
            try {
                $response = Http::timeout(10)->get('https://data.bantulkab.go.id/api/instansi');
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

        return view('livewire.public-aliran-data-table', compact('dinasList'));
    }
}
