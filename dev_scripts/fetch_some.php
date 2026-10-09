<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

$allData = [];

// Fetch data from 13100 (Perumdam)
echo "Fetching Perumdam...\n";
$res1 = Http::withoutVerifying()->timeout(30)->get('https://data.bantulkab.go.id/api/indikator', ['instansi_code' => '13100', 'page' => 1]);
if ($res1->successful() && $res1->json('status') !== 'error') {
    $result = $res1->json('data.result');
    if (is_array($result)) {
        foreach ($result as $item) {
            $item['dinas_nama'] = 'Perumdam Tirta Projotamansari Kabupaten Bantul';
            $allData[] = $item;
        }
    }
}

// Fetch data from 10403 (Disdukcapil)
echo "Fetching Disdukcapil...\n";
$res2 = Http::withoutVerifying()->timeout(30)->get('https://data.bantulkab.go.id/api/indikator', ['instansi_code' => '10403', 'page' => 1]);
if ($res2->successful() && $res2->json('status') !== 'error') {
    $result = $res2->json('data.result');
    if (is_array($result)) {
        foreach ($result as $item) {
            $item['dinas_nama'] = 'Dinas Kependudukan dan Catatan Sipil';
            $allData[] = $item;
        }
    }
}

Storage::disk('local')->put('aliran_data_all.json', json_encode($allData));
echo "Saved " . count($allData) . " items.\n";
