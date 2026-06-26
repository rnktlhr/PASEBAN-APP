<?php

namespace App\Console\Commands;

use App\Models\Dinas;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SyncInstansiCode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-instansi-code';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sinkronisasi instansi_code dari API Sedata Sebantul berdasarkan kecocokan nama dinas';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Mengambil data instansi dari Sedata Sebantul...');

        $response = Http::timeout(15)->get('https://data.bantulkab.go.id/api/instansi');

        if (!$response->successful()) {
            $this->error('Gagal menghubungi API Sedata Sebantul.');
            return;
        }

        $apiData = $response->json('data.result');

        if (!is_array($apiData)) {
            $this->error('Format data dari API tidak sesuai (harus berupa array).');
            return;
        }

        $dinasList = Dinas::all();
        $this->info('Total Instansi API: ' . count($apiData));
        $this->info('Total Dinas Lokal: ' . $dinasList->count());
        $matched = 0;

        foreach ($apiData as $apiInstansi) {
            $apiCode = $apiInstansi['instansi_cd'] ?? null;
            $apiName = strtolower(trim($apiInstansi['instansi_name'] ?? ''));

            if (!$apiCode || !$apiName) continue;

            $apiNameSlug = \Illuminate\Support\Str::slug($apiName);
            // Hapus kata 'dinas', 'badan', 'kabupaten', 'bantul' agar lebih fleksibel
            $apiNameSlug = str_replace(['dinas-', 'badan-', '-kabupaten-bantul'], '', $apiNameSlug);

            // Cari kemiripan nama
            $dinas = $dinasList->first(function ($item) use ($apiNameSlug) {
                $localSlug = \Illuminate\Support\Str::slug($item->nama);
                $localSlug = str_replace(['dinas-', 'badan-', '-kabupaten-bantul'], '', $localSlug);
                
                return $localSlug === $apiNameSlug || str_contains($localSlug, $apiNameSlug) || str_contains($apiNameSlug, $localSlug);
            });

            if ($dinas) {
                $dinas->update(['instansi_code' => $apiCode]);
                $this->line("<info>Berhasil mencocokkan:</info> {$dinas->nama} -> {$apiCode}");
                $matched++;
            }
        }

        $this->info("Proses sinkronisasi selesai. {$matched} Instansi berhasil dicocokkan otomatis.");
    }
}
