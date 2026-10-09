<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Http;

$instansis = Http::withoutVerifying()->get('https://data.bantulkab.go.id/api/instansi')->json('data.result') ?? [];
$allData = [];

foreach ($instansis as $idx => $instansi) {
    $code = $instansi['instansi_cd'] ?? null;
    $name = $instansi['instansi_name'] ?? '-';
    if (!$code) continue;

    echo "Fetching $code...\n";
    $page = 1;
    $lastPage = 1;
    
    do {
        $res = Http::withoutVerifying()->timeout(10)->get('https://data.bantulkab.go.id/api/indikator', [
            'instansi_code' => $code,
            'page' => $page,
        ]);
        
        if ($res->successful() && $res->json('status') !== 'error') {
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
}

file_put_contents(storage_path('app/aliran_data_all.json'), json_encode($allData));
echo "Saved " . count($allData) . " items.\n";
