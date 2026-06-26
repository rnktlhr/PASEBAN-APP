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
            $response = Http::timeout(15)->get('https://data.bantulkab.go.id/api/instansi');
            
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

            $bar = $this->output->createProgressBar($totalDinas);
            $bar->start();

            foreach ($instansis as $instansi) {
                $code = $instansi['instansi_cd'] ?? null;
                if (!$code) {
                    $bar->advance();
                    continue;
                }

                // Cek indikator untuk dinas ini
                try {
                    $res = Http::timeout(10)->withHeaders([
                        'X-instansi-Code' => $code
                    ])->get('https://data.bantulkab.go.id/api/indikator');

                    if ($res->successful() && $res->json('status') !== 'error') {
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
