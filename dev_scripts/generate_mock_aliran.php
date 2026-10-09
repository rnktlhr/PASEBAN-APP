<?php
$data = [];
$instansis = [
    'Perumdam Tirta Projotamansari Kabupaten Bantul' => '13100',
    'Dinas Kependudukan dan Catatan Sipil' => '10403',
    'Dinas Kesehatan' => '10101'
];

$id = 1;
foreach ($instansis as $name => $code) {
    for ($i = 1; $i <= 15; $i++) {
        $data[] = [
            'id_data' => "9.10." . str_pad($id++, 4, '0', STR_PAD_LEFT),
            'nama_data' => "Data Indikator " . $i . " dari " . explode(' ', $name)[0],
            'cakupan' => "Kabupaten",
            'pemutahiran' => "Tahunan",
            'dinas_nama' => $name
        ];
    }
}

file_put_contents(__DIR__ . '/storage/app/aliran_data_all.json', json_encode($data, JSON_PRETTY_PRINT));
echo "Generated " . count($data) . " mock items.\n";
