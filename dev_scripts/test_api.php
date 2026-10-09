<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $res = \Illuminate\Support\Facades\Http::withoutVerifying()->timeout(10)->get('https://data.bantulkab.go.id/api/instansi');
    echo "Status: " . $res->status() . "\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
