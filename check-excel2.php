<?php
require __DIR__.'/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

$file = 'Identifikasi kegiatan statistik sektoral OPD Bantul 2026.xlsx';
$spreadsheet = IOFactory::load($file);
$worksheet = $spreadsheet->getActiveSheet();
$count = 0;
$highestRow = $worksheet->getHighestDataRow();

echo "Highest Data Row: " . $highestRow . "\n";
foreach ($worksheet->getRowIterator() as $row) {
    if ($row->getRowIndex() >= 3) {
        $cellVal = $worksheet->getCell('C'.$row->getRowIndex())->getValue();
        if (trim((string)$cellVal) !== '') {
            $count++;
        }
    }
}
echo "Count >= 3 with data in C: " . $count . "\n";
