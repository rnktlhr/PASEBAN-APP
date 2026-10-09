<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

$allData = [];

$targets = [
    '13100' => 'Perumdam Tirta Projotamansari Kabupaten Bantul',
    '10101' => 'Dinas Kesehatan',
    '10401' => 'Dinas Sosial',
    '10402' => 'Dinas Tenaga Kerja dan Transmigrasi'
];

foreach ($targets as $code => $name) {
    echo "Fetching $name...\n";
    $res = Http::withoutVerifying()->timeout(20)->get('https://data.bantulkab.go.id/api/indikator', ['instansi_code' => $code, 'page' => 1]);
    if ($res->successful() && $res->json('status') !== 'error') {
        $result = $res->json('data.result');
        if (is_array($result)) {
            // take up to 5 items per instansi to mix them up
            $subset = array_slice($result, 0, 5);
            foreach ($subset as $item) {
                $item['dinas_nama'] = $name;
                $allData[] = $item;
            }
        }
    }
}

Storage::disk('local')->put('aliran_data_all.json', json_encode($allData));
echo "Saved " . count($allData) . " items.\n";
