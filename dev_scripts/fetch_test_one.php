<?php
$url = 'https://data.bantulkab.go.id/api/indikator?instansi_code=13100';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_TIMEOUT, 20);
$output = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Curl error: ' . curl_error($ch) . "\n";
} else {
    $data = json_decode($output, true);
    if (isset($data['data']['result'])) {
        echo "Success, items: " . count($data['data']['result']) . "\n";
    } else {
        echo "No data\n";
    }
}
