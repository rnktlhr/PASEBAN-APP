<?php

use App\Models\KegiatanStatistik;
use App\Models\Romantik;
use App\Models\Metadata;
use App\Models\AliranData;
use App\Models\Monev;
use App\Enums\StatusDinas;
use App\Enums\StatusKominfo;
use App\Enums\StatusBps;
use App\Enums\JenisMetadata;
use App\Enums\JenisKegiatan;
use Illuminate\Support\Facades\DB;

DB::statement('SET FOREIGN_KEY_CHECKS=0;');
AliranData::truncate();
Metadata::truncate();
Romantik::truncate();
Monev::truncate();
KegiatanStatistik::truncate();
DB::statement('SET FOREIGN_KEY_CHECKS=1;');

$dinasIds = App\Models\Dinas::take(5)->pluck('id')->toArray();
$tahun = 2026;

for ($i = 1; $i <= 5; $i++) {
    $kegiatan = KegiatanStatistik::create([
        'dinas_id' => $dinasIds[($i-1) % count($dinasIds)] ?? 1,
        'nama' => "Kegiatan Statistik Contoh $i",
        'jenis' => JenisKegiatan::SURVEI->value,
        'tahun' => $tahun
    ]);

    Romantik::create([
        'kegiatan_id' => $kegiatan->id,
        'tahun' => $tahun,
        'status_dinas' => $i <= 3 ? StatusDinas::SUDAH_DIAJUKAN->value : StatusDinas::BELUM_DIAJUKAN->value,
        'status_kominfo' => StatusKominfo::SEDANG_DIPERIKSA->value,
        'status_bps' => StatusBps::SEDANG_DIPERIKSA->value,
        'catatan' => "Catatan uji coba romantik $i",
    ]);

    Metadata::create([
        'kegiatan_id' => $kegiatan->id,
        'jenis' => JenisMetadata::KEGIATAN->value,
        'tahun' => $tahun,
        'status_dinas' => $i <= 2 ? StatusDinas::SUDAH_DIAJUKAN->value : StatusDinas::BELUM_DIAJUKAN->value,
        'status_kominfo' => $i <= 2 ? StatusKominfo::DISETUJUI->value : StatusKominfo::DRAFT->value,
        'status_bps' => StatusBps::DISETUJUI->value,
    ]);
    
    Metadata::create([
        'kegiatan_id' => $kegiatan->id,
        'jenis' => JenisMetadata::VARIABEL->value,
        'tahun' => $tahun,
        'status_dinas' => StatusDinas::BELUM_DIAJUKAN->value,
        'status_kominfo' => StatusKominfo::DRAFT->value,
        'status_bps' => StatusBps::SEDANG_DIPERIKSA->value,
    ]);
    
    Metadata::create([
        'kegiatan_id' => $kegiatan->id,
        'jenis' => JenisMetadata::INDIKATOR->value,
        'tahun' => $tahun,
        'status_dinas' => StatusDinas::BELUM_DIAJUKAN->value,
        'status_kominfo' => StatusKominfo::DRAFT->value,
        'status_bps' => StatusBps::SEDANG_DIPERIKSA->value,
    ]);

    AliranData::create([
        'kegiatan_id' => $kegiatan->id,
        'nama_data' => "Data Output Sedata $i",
        'tahun' => $tahun,
        'frekuensi' => 'tahunan',
        'sudah_tayang' => $i == 1 ? true : false,
    ]);
}

echo "Testing data 5 records generated successfully!\n";
