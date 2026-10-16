<?php
require __DIR__.'/../vendor/autoload.php';

$jsonPath = __DIR__ . '/../storage/app/aliran_data_all.json';
$data = json_decode(file_get_contents($jsonPath), true);
$d = [];
foreach ($data as $row) {
    $name = $row['dinas_nama'] ?? 'Lainnya';
    $d[$name] = ($d[$name] ?? 0) + 1;
}
arsort($d);
echo "Total records: " . count($data) . "\n";
echo "Top 10 Dinas by data count:\n";
print_r(array_slice($d, 0, 10, true));
