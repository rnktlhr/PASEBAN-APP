<?php
$url = 'https://data.bantulkab.go.id/api/indikator';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$output = curl_exec($ch);
curl_close($ch);
echo substr($output, 0, 500);
