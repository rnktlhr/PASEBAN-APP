<?php

namespace App\Imports;

use App\Models\KegiatanStatistik;
use App\Models\Dinas;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class KegiatanStatistikImport implements ToCollection, WithStartRow
{
    protected $tahun;

    public function __construct($tahun = null)
    {
        $this->tahun = $tahun ?? date('Y');
    }

    public function startRow(): int
    {
        return 2; // Data starts at row 2 (skip 1 header row)
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Check if column 2 (Judul Kegiatan) is filled
            if (!isset($row[2]) || trim($row[2]) === '') {
                continue;
            }

            $namaKegiatan = trim($row[2]);
            $namaDinas = trim($row[5] ?? '');
            $caraPengumpulan = trim($row[6] ?? '');

            // Determine jenis
            $jenis = 'survei'; // default
            if ($caraPengumpulan == '1' || stripos($caraPengumpulan, 'lengkap') !== false) {
                $jenis = 'pendataan_lengkap';
            } elseif ($caraPengumpulan == '3' || stripos($caraPengumpulan, 'kompilasi') !== false || stripos($caraPengumpulan, 'kompromin') !== false) {
                $jenis = 'kompromin';
            } else {
                $jenis = 'survei';
            }

            // Find Dinas
            $dinas = null;
            if ($namaDinas) {
                $dinas = Dinas::where('nama', $namaDinas)->first();
                if (!$dinas) {
                    $dinas = Dinas::where('nama', 'like', '%' . $namaDinas . '%')->first();
                }
            }
            
            // If dinas is not found, we use a fallback or skip. We will fallback to 1 (usually default or Dinas Sosial in seeder) to ensure data is saved,
            // or we could throw an exception. We'll fallback to 1 to allow the user to see the data and edit it later.
            $dinasId = $dinas ? $dinas->id : 1;

            KegiatanStatistik::updateOrCreate([
                'nama' => $namaKegiatan,
                'tahun' => $this->tahun,
            ], [
                'dinas_id' => $dinasId,
                'jenis' => $jenis,
            ]);
        }
    }
}
