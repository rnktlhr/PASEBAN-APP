<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

$url = config('services.bantul.api_url') . '/instansi';
echo "Fetching from: $url\n";
$response = Http::withoutVerifying()->timeout(30)->get($url);

if (!$response->successful()) {
    die("Failed to fetch instansi.\n");
}

$instansiData = $response->json('data.result');
if (empty($instansiData)) {
    die("Empty data.\n");
}

$seederRows = [];
foreach ($instansiData as $instansi) {
    $nama = addslashes($instansi['instansi_name']);
    $code = addslashes($instansi['instansi_cd']);
    $singkatan = addslashes(Str::limit($instansi['instansi_name'], 15, '')); 
    
    $words = explode(' ', preg_replace('/[^a-zA-Z0-9 ]/', '', $instansi['instansi_name']));
    $acronym = '';
    foreach ($words as $w) {
      if (strlen($w) > 2) { $acronym .= strtoupper($w[0]); }
    }
    if (empty($acronym)) $acronym = 'OPD';
    $acronym = addslashes(substr($acronym, 0, 10)); // keep it short
    
    $seederRows[] = "        ['$nama', '$acronym', '$code'],";
}

$rowsString = implode("\n", $seederRows);

$seederContent = <<<PHP
<?php

namespace Database\Seeders;

use App\Models\Dinas;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DinasSeeder extends Seeder
{
    public const DATA = [
$rowsString
    ];

    public function run(): void
    {
        foreach (self::DATA as \$index => \$item) {
            // override diskominfo slug manual so admin seeder doesn't break
            \$slug = Str::slug(\$item[1] . '-' . \$item[2]);
            if (str_contains(strtolower(\$item[0]), 'komunikasi dan informatika')) {
                \$slug = 'diskominfo';
            }
            
            Dinas::updateOrCreate(
                ['instansi_code' => \$item[2]],
                [
                    'nama' => \$item[0],
                    'singkatan' => \$item[1],
                    'slug' => \$slug,
                ]
            );
        }
    }
}
PHP;

file_put_contents(__DIR__ . '/../database/seeders/DinasSeeder.php', $seederContent);
echo "Generated DinasSeeder with " . count($instansiData) . " OPDs.\n";
