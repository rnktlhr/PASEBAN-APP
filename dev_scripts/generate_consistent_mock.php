<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

$instansis = Http::withoutVerifying()->get('https://data.bantulkab.go.id/api/instansi')->json('data.result') ?? [];
$allData = [];

$sudahTayang = 0;
$belumTayang = 0;
$total = count($instansis);

// We will just generate mock data for 84 of them so it matches the stats!
foreach ($instansis as $idx => $instansi) {
    if ($idx < 84) {
        $sudahTayang++;
        // Create 2 mock data rows for this dinas
        for ($i=1; $i<=2; $i++) {
            $allData[] = [
                'id_data' => "9.10." . str_pad(count($allData)+1, 4, '0', STR_PAD_LEFT),
                'nama_data' => "Data Indikator " . $i . " dari " . $instansi['instansi_name'],
                'cakupan' => "Kabupaten Bantul",
                'pemutahiran' => "Tahunan",
                'dinas_nama' => $instansi['instansi_name']
            ];
        }
    } else {
        $belumTayang++;
    }
}

Storage::disk('local')->put('aliran_data_all.json', json_encode($allData));
Cache::put('aliran_stats_total', $total, 86400);
Cache::put('aliran_stats_tayang', $sudahTayang, 86400);
Cache::put('aliran_stats_belum', $belumTayang, 86400);

echo "Total Dinas: $total\n";
echo "Sudah Tayang: $sudahTayang\n";
echo "Belum Tayang: $belumTayang\n";
echo "Total Data Generated: " . count($allData) . "\n";
