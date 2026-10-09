<?php
require __DIR__.'/vendor/autoload.php';
use Illuminate\Support\Facades\Http;
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$res = Http::withoutVerifying()->timeout(30)->get('https://data.bantulkab.go.id/api/indikator', [
    'page' => 1
]);
if ($res->successful()) {
    $meta = $res->json('data.meta');
    echo "Total Data: " . ($meta['total'] ?? 'unknown') . "\n";
    echo "Total Pages: " . ($meta['lastPage'] ?? 'unknown') . "\n";
} else {
    echo "Failed: " . $res->status();
}
