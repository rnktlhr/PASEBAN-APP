<?php
require __DIR__.'/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

$file = 'Identifikasi kegiatan statistik sektoral OPD Bantul 2026.xlsx';
$spreadsheet = IOFactory::load($file);
$worksheet = $spreadsheet->getActiveSheet();

echo "Checking rows 3 to 55...\n";
$previousNo = 0;
foreach ($worksheet->getRowIterator() as $row) {
    if ($row->getRowIndex() >= 3) {
        $no = $worksheet->getCell('A'.$row->getRowIndex())->getValue();
        $nama = $worksheet->getCell('C'.$row->getRowIndex())->getValue();
        
        if ($no != ($previousNo + 1)) {
            echo "Jump detected at row " . $row->getRowIndex() . ": previousNo=$previousNo, currentNo=$no, nama=$nama\n";
        }
        $previousNo = (int)$no;
    }
}
