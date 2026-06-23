<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use PhpOffice\PhpSpreadsheet\IOFactory;

$file = 'Identifikasi kegiatan statistik Sektoral OPD Bantul 2026.xlsx';
if (!file_exists($file)) {
    echo "File $file not found!\n";
    exit;
}

$spreadsheet = IOFactory::load($file);
$worksheet = $spreadsheet->getActiveSheet();

$names = [];
$duplicates = [];
$rowCount = 0;
$skippedCount = 0;

foreach ($worksheet->getRowIterator() as $row) {
    $rowIndex = $row->getRowIndex();
    if ($rowIndex < 3) continue; // Start at row 3
    
    $cellIterator = $row->getCellIterator();
    $cellIterator->setIterateOnlyExistingCells(false);
    
    $rowData = [];
    foreach ($cellIterator as $cell) {
        $rowData[] = $cell->getValue();
    }
    
    // Check if column 2 (index 2 since it's 0-indexed in our code logic... Wait!)
    // In Maatwebsite\Excel, row[2] means column C (0 is A, 1 is B, 2 is C).
    // Let's print out what column C is.
    $nama = trim((string)($rowData[2] ?? ''));
    if ($nama === '') {
        $skippedCount++;
        continue;
    }
    
    $rowCount++;
    if (isset($names[$nama])) {
        $duplicates[] = $nama;
    }
    $names[$nama] = true;
}

echo "Total valid rows: $rowCount\n";
echo "Total skipped: $skippedCount\n";
echo "Duplicates found: " . count($duplicates) . "\n";
if (count($duplicates) > 0) {
    print_r($duplicates);
}
