<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class PantauAliranData extends Page
{
    protected string $view = 'filament.pages.pantau-aliran-data';

    public static function getNavigationIcon(): string|\Illuminate\Contracts\Support\Htmlable|null
    {
        return 'heroicon-o-table-cells';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Data';
    }

    public function getTitle(): string|\Illuminate\Contracts\Support\Htmlable
    {
        return 'Aliran Data (API)';
    }

    public static function getNavigationLabel(): string
    {
        return 'Aliran Data';
    }

    public $dinasId;
    public $indikatorData = [];
    public $isLoading = false;

    public function getDinasOptionsProperty()
    {
        // Ambil dari API Sedata Sebantul
        $options = Cache::remember('api_instansi_list', 3600, function () {
            try {
                $response = Http::timeout(10)->get('https://data.bantulkab.go.id/api/instansi');
                if ($response->successful()) {
                    return collect($response->json('data.result'))
                        ->pluck('instansi_name', 'instansi_cd')
                        ->toArray();
                }
            } catch (\Exception $e) {
                // handle silently
            }
            return [];
        });

        // Sort alphabetically
        asort($options);
        return $options;
    }

    public function updatedDinasId($value)
    {
        $this->fetchData();
    }

    public function fetchData()
    {
        $this->indikatorData = [];
        if (!$this->dinasId) {
            return;
        }

        $this->isLoading = true;

        try {
            $response = Http::timeout(15)->withHeaders([
                'X-instansi-Code' => $this->dinasId,
            ])->get('https://data.bantulkab.go.id/api/indikator');

            if ($response->successful()) {
                $data = $response->json('data.result');
                if (is_array($data)) {
                    $this->indikatorData = $data;
                }
            }
        } catch (\Exception $e) {
            // handle error silently or log
        }

        $this->isLoading = false;
    }
}
