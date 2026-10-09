<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Client\Pool;

echo "Fetching instansis...\n";
$instansis = Http::withoutVerifying()->get('https://data.bantulkab.go.id/api/instansi')->json('data.result') ?? [];
$total = count($instansis);
echo "Got $total instansis. Starting concurrent requests (timeout 15s)...\n";

$responses = Http::withoutVerifying()->pool(function (Pool $pool) use ($instansis) {
    $requests = [];
    foreach ($instansis as $idx => $instansi) {
        $code = $instansi['instansi_cd'] ?? null;
        if ($code) {
            $requests[] = $pool->as($code)->timeout(15)->get('https://data.bantulkab.go.id/api/indikator', [
                'instansi_code' => $code,
                'page' => 1
            ]);
        }
    }
    return $requests;
});

echo "All requests finished! Processing...\n";

$allData = [];
$sudahTayang = 0;
$belumTayang = 0;

foreach ($instansis as $instansi) {
    $code = $instansi['instansi_cd'] ?? null;
    $name = $instansi['instansi_name'] ?? '-';
    if (!$code) continue;

    $hasData = false;
    if (isset($responses[$code]) && $responses[$code] instanceof \Illuminate\Http\Client\Response && $responses[$code]->successful()) {
        $json = $responses[$code]->json();
        if ($json && isset($json['status']) && $json['status'] !== 'error') {
            $result = $json['data']['result'] ?? [];
            if (is_array($result) && count($result) > 0) {
                $hasData = true;
                foreach ($result as $item) {
                    $item['dinas_nama'] = $name;
                    $allData[] = $item;
                }
            }
        }
    }

    if ($hasData) {
        $sudahTayang++;
    } else {
        $belumTayang++;
    }
}

Storage::disk('local')->put('aliran_data_all.json', json_encode($allData));
Cache::put('aliran_stats_total', $total, 86400);
Cache::put('aliran_stats_tayang', $sudahTayang, 86400);
Cache::put('aliran_stats_belum', $belumTayang, 86400);

echo "Done! Real Data Saved!\n";
echo "Total Dinas: $total\n";
echo "Sudah Tayang: $sudahTayang\n";
echo "Belum Tayang: $belumTayang\n";
echo "Total Data Rows Fetched: " . count($allData) . "\n";
