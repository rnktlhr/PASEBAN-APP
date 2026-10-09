<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class SyncAliranStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-aliran-stats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sinkronisasi total dinas yang sudah tayang vs belum tayang dari API Sedata Sebantul';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Memulai sinkronisasi statistik Aliran Data...');

        try {
            // Ambil daftar instansi
            $response = Http::timeout(15)->get(config('services.bantul.api_url') . '/instansi');

            if (!$response->successful()) {
                $this->error('Gagal mengambil daftar instansi dari API.');
                return self::FAILURE;
            }

            $instansis = $response->json('data.result');
            if (!is_array($instansis)) {
                $this->error('Format data instansi tidak sesuai.');
                return self::FAILURE;
            }

            $totalDinas = count($instansis);
            $sudahTayang = 0;
            $belumTayang = 0;
            $allData = [];

            $bar = $this->output->createProgressBar($totalDinas);
            $bar->start();

            foreach ($instansis as $instansi) {
                $code = $instansi['instansi_cd'] ?? null;
                $name = $instansi['instansi_name'] ?? '-';
                if (!$code) {
                    $bar->advance();
                    continue;
                }

                // Cek indikator untuk dinas ini dan kumpulkan semua data
                try {
                    $page = 1;
                    $lastPage = 1;
                    $hasData = false;

                    do {
                        $res = Http::withoutVerifying()->timeout(10)->get(config('services.bantul.api_url') . '/indikator', [
                            'instansi_code' => $code,
                            'page' => $page,
                        ]);

                        if ($res->successful() && $res->json('status') !== 'error') {
                            $hasData = true;
                            $result = $res->json('data.result');
                            
                            if (is_array($result)) {
                                foreach ($result as $item) {
                                    $item['dinas_nama'] = $name;
                                    $allData[] = $item;
                                }
                            }
                            
                            $lastPage = $res->json('data.meta.lastPage') ?? 1;
                            $page++;
                        } else {
                            break;
                        }
                    } while ($page <= $lastPage);

                    if ($hasData) {
                        $sudahTayang++;
                    } else {
                        $belumTayang++;
                    }

                } catch (\Exception $e) {
                    // Timeout or error -> anggap belum tayang
                    $belumTayang++;
                }

                $bar->advance();
            }

            $bar->finish();
            $this->newLine();

            // Simpan semua data ke file JSON agar bisa diakses cepat tanpa API calls lambat
            \Illuminate\Support\Facades\Storage::disk('local')->put('aliran_data_all.json', json_encode($allData));

            // Simpan ke Cache selama 24 jam (86400 detik)
            Cache::put('aliran_stats_total', $totalDinas, 86400);
            Cache::put('aliran_stats_tayang', $sudahTayang, 86400);
            Cache::put('aliran_stats_belum', $belumTayang, 86400);

            $this->info("Sinkronisasi selesai! Total: $totalDinas, Tayang: $sudahTayang, Belum Tayang: $belumTayang");

            return self::SUCCESS;

        } catch (\Exception $e) {
            $this->error('Terjadi kesalahan: ' . $e->getMessage());
            return self::FAILURE;
        }
    }
}
