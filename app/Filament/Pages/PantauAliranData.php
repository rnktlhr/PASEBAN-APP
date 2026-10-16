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

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('syncApi')
                ->label('Sinkronisasi Data API')
                ->icon('heroicon-o-arrow-path')
                ->color('primary')
                ->requiresConfirmation()
                ->modalHeading('Sinkronkan Data dari API Sedata Sebantul?')
                ->modalDescription('Proses ini akan menarik data indikator terbaru dari seluruh OPD di Sedata Sebantul dan memperbarui jumlah data.')
                ->action(function () {
                    \Illuminate\Support\Facades\Artisan::call('app:sync-aliran-stats');
                    \Filament\Notifications\Notification::make()
                        ->title('Sinkronisasi Selesai')
                        ->body('Data aliran statistik berhasil disinkronkan dari API Sedata Sebantul.')
                        ->success()
                        ->send();
                }),
        ];
    }

    public $dinasId;
    public $indikatorData = [];
    public $isLoading = false;

    public function getDinasOptionsProperty()
    {
        // Ambil dari API Sedata Sebantul
        $options = Cache::remember('api_instansi_list', 3600, function () {
            try {
                $response = Http::timeout(10)->get(config('services.bantul.api_url') . '/instansi');
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
            $response = Http::withoutVerifying()->timeout(15)->get(config('services.bantul.api_url') . '/indikator', [
                'instansi_code' => $this->dinasId,
            ]);

            if ($response->successful()) {
                $data = $response->json('data.result');
                if (is_array($data)) {
                    usort($data, function ($itemA, $itemB) {
                        $minA = parse_relative_time_to_minutes($itemA['pemutahiran'] ?? null);
                        $minB = parse_relative_time_to_minutes($itemB['pemutahiran'] ?? null);

                        if ($minA === $minB) {
                            return strcmp($itemA['id_data'] ?? '', $itemB['id_data'] ?? '');
                        }

                        return $minA <=> $minB;
                    });
                    $this->indikatorData = $data;
                }
            } else {
                \Illuminate\Support\Facades\Log::error('API Indikator Error', ['status' => $response->status(), 'body' => $response->body()]);
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('API Indikator Exception', ['msg' => $e->getMessage()]);
        }

        $this->isLoading = false;
    }
}
