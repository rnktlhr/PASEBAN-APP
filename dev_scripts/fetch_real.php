<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

echo "Fetching instansis...\n";
$instansis = Http::withoutVerifying()->get('https://data.bantulkab.go.id/api/instansi')->json('data.result') ?? [];
$allData = [];

$sudahTayang = 0;
$belumTayang = 0;
$total = count($instansis);

foreach ($instansis as $idx => $instansi) {
    $code = $instansi['instansi_cd'] ?? null;
    $name = $instansi['instansi_name'] ?? '-';
    if (!$code) continue;

    echo "[" . ($idx+1) . "/$total] Fetching $name ($code)...\n";
    $hasData = false;
    
    try {
        $res = Http::withoutVerifying()->timeout(2)->get('https://data.bantulkab.go.id/api/indikator', [
            'instansi_code' => $code,
            'page' => 1, // Only get page 1 for speed right now, up to 10 items per dinas
        ]);

        if ($res->successful() && $res->json('status') !== 'error') {
            $result = $res->json('data.result');
            if (is_array($result) && count($result) > 0) {
                $hasData = true;
                foreach ($result as $item) {
                    $item['dinas_nama'] = $name;
                    $allData[] = $item;
                }
            }
        }
    } catch (\Exception $e) {
        echo "  Timeout or error.\n";
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

echo "Done! Total Data Rows: " . count($allData) . "\n";
echo "Tayang: $sudahTayang, Belum: $belumTayang\n";
