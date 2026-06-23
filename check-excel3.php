<?php
require __DIR__.'/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

$file = 'Identifikasi kegiatan statistik sektoral OPD Bantul 2026.xlsx';
$spreadsheet = IOFactory::load($file);
$worksheet = $spreadsheet->getActiveSheet();
$highestRow = $worksheet->getHighestDataRow();

echo "Row No -> Nama Kegiatan\n";
foreach ($worksheet->getRowIterator() as $row) {
    if ($row->getRowIndex() >= 50) {
        $no = $worksheet->getCell('A'.$row->getRowIndex())->getValue();
        $nama = $worksheet->getCell('C'.$row->getRowIndex())->getValue();
        echo "Row " . $row->getRowIndex() . " | No: $no | Nama: $nama\n";
    }
}
