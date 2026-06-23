<?php
require __DIR__.'/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

$file = 'Identifikasi kegiatan statistik sektoral OPD Bantul 2026.xlsx';
$spreadsheet = IOFactory::load($file);
$worksheet = $spreadsheet->getActiveSheet();

echo "Rows 1 to 10:\n";
foreach ($worksheet->getRowIterator() as $row) {
    if ($row->getRowIndex() <= 10) {
        $a = $worksheet->getCell('A'.$row->getRowIndex())->getValue();
        $b = $worksheet->getCell('B'.$row->getRowIndex())->getValue();
        $c = $worksheet->getCell('C'.$row->getRowIndex())->getValue();
        echo "Row " . $row->getRowIndex() . " | A: $a | B: $b | C: $c\n";
    }
}
