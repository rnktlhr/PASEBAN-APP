<?php

namespace Database\Seeders;

use App\Models\AliranData;
use App\Models\BeritaAcara;
use App\Models\Dinas;
use App\Models\KegiatanStatistik;
use App\Models\Metadata;
use App\Models\Monev;
use App\Models\Pembinaan;
use App\Models\PresensiPembinaan;
use App\Models\Romantik;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ──────────────────────────────────────────────
        // 1. Dinas / OPD Kabupaten Bantul
        // ──────────────────────────────────────────────
        $dinasData = [
            ['nama' => 'Dinas Sosial',                               'singkatan' => 'Dinsos',       'kategori' => 'Sosial'],
            ['nama' => 'Dinas Kesehatan',                            'singkatan' => 'Dinkes',       'kategori' => 'Kesehatan'],
            ['nama' => 'Dinas Pendidikan, Pemuda dan Olahraga',      'singkatan' => 'Disdikpora',   'kategori' => 'Pendidikan'],
            ['nama' => 'Dinas Pertanahan dan Tata Ruang',            'singkatan' => 'Dispertaru',   'kategori' => 'Pertanahan'],
            ['nama' => 'Dinas Pertanian dan Pangan',                 'singkatan' => 'Dispertan',    'kategori' => 'Pertanian'],
            ['nama' => 'Dinas Perindustrian dan Perdagangan',        'singkatan' => 'Disperindag',  'kategori' => 'Ekonomi'],
            ['nama' => 'Dinas Komunikasi dan Informatika',           'singkatan' => 'Diskominfo',   'kategori' => 'Teknologi'],
            ['nama' => 'Dinas Kependudukan dan Pencatatan Sipil',    'singkatan' => 'Disdukcapil',  'kategori' => 'Kependudukan'],
            ['nama' => 'Dinas Lingkungan Hidup',                     'singkatan' => 'DLH',          'kategori' => 'Lingkungan'],
            ['nama' => 'Dinas Kebudayaan',                           'singkatan' => 'Disbud',       'kategori' => 'Budaya'],
            ['nama' => 'Dinas Perpustakaan dan Kearsipan',           'singkatan' => 'Dispusip',     'kategori' => 'Perpustakaan'],
            ['nama' => 'Dinas Tenaga Kerja dan Transmigrasi',        'singkatan' => 'Disnakertrans','kategori' => 'Ketenagakerjaan'],
            ['nama' => 'Dinas Pekerjaan Umum, Perumahan, dan Kawasan Permukiman', 'singkatan' => 'DPUPKP', 'kategori' => 'Infrastruktur'],
            ['nama' => 'Dinas Perhubungan',                          'singkatan' => 'Dishub',       'kategori' => 'Perhubungan'],
            ['nama' => 'Dinas Pemberdayaan Perempuan dan Perlindungan Anak', 'singkatan' => 'DP3A', 'kategori' => 'Sosial'],
            ['nama' => 'Badan Perencanaan Pembangunan Daerah',       'singkatan' => 'Bappeda',      'kategori' => 'Perencanaan'],
            ['nama' => 'Badan Keuangan dan Aset Daerah',             'singkatan' => 'BKAD',         'kategori' => 'Keuangan'],
            ['nama' => 'Badan Kepegawaian, Pendidikan dan Pelatihan','singkatan' => 'BKPP',         'kategori' => 'Kepegawaian'],
            ['nama' => 'Inspektorat Daerah',                         'singkatan' => 'Inspektorat',  'kategori' => 'Pengawasan'],
            ['nama' => 'Dinas Pariwisata',                           'singkatan' => 'Disparwis',    'kategori' => 'Pariwisata'],
            ['nama' => 'Dinas Koperasi, UKM dan Perindustrian',      'singkatan' => 'Diskop',       'kategori' => 'Ekonomi'],
            ['nama' => 'Dinas Penanaman Modal dan Pelayanan Terpadu','singkatan' => 'DPMPT',        'kategori' => 'Investasi'],
            ['nama' => 'Satuan Polisi Pamong Praja',                 'singkatan' => 'Satpol PP',    'kategori' => 'Ketertiban'],
            ['nama' => 'Badan Penanggulangan Bencana Daerah',        'singkatan' => 'BPBD',         'kategori' => 'Kebencanaan'],
            ['nama' => 'Sekretariat Daerah',                         'singkatan' => 'Setda',        'kategori' => 'Pemerintahan'],
        ];

        $dinasList = [];
        foreach ($dinasData as $d) {
            $dinasList[] = Dinas::create($d);
        }

        // ──────────────────────────────────────────────
        // 2. Users (4 roles)
        // ──────────────────────────────────────────────
        User::create([
            'name'     => 'Admin BPS Bantul',
            'email'    => 'admin@bps.go.id',
            'password' => Hash::make('password'),
            'role'     => 'admin_bps',
        ]);

        // Kominfo user linked to Diskominfo
        $kominfoDinas = $dinasList[6]; // Diskominfo
        User::create([
            'name'     => 'Operator Kominfo',
            'email'    => 'kominfo@bantulkab.go.id',
            'password' => Hash::make('password'),
            'role'     => 'kominfo',
            'dinas_id' => $kominfoDinas->id,
        ]);

        // Bappeda viewer
        $bappedaDinas = $dinasList[15]; // Bappeda
        User::create([
            'name'     => 'Viewer Bappeda',
            'email'    => 'bappeda@bantulkab.go.id',
            'password' => Hash::make('password'),
            'role'     => 'bappeda',
            'dinas_id' => $bappedaDinas->id,
        ]);

        // Create a Dinas user for Dinas Sosial
        User::create([
            'name'     => 'Operator Dinas Sosial',
            'email'    => 'dinsos@bantulkab.go.id',
            'password' => Hash::make('password'),
            'role'     => 'dinas',
            'dinas_id' => $dinasList[0]->id,
        ]);

        // ──────────────────────────────────────────────
        // 3. Kegiatan Statistik (75 total, spread across dinas & years)
        // ──────────────────────────────────────────────
        $jenisOpsi = ['survei', 'pendataan_lengkap', 'kompromin'];
        $namaKegiatan = [
            'Survei Kebahagiaan', 'Pendataan UMKM', 'Survei Kepuasan Masyarakat',
            'Pendataan Penyandang Disabilitas', 'Kompilasi Data Kependudukan',
            'Survei Sosial Ekonomi', 'Pendataan Infrastruktur Jalan', 'Survei Transportasi Publik',
            'Pendataan Potensi Desa', 'Kompilasi Data Kesehatan Ibu dan Anak',
            'Survei Indeks Pembangunan Manusia', 'Pendataan Wisatawan', 'Kompilasi Data Pertanian',
            'Survei Tingkat Pengangguran', 'Pendataan Sekolah dan Guru',
        ];

        $allKegiatan = [];

        // 2026 — 75 kegiatan
        $kegIdx = 0;
        foreach ($dinasList as $i => $dinas) {
            $count = ($i < 10) ? 4 : (($i < 20) ? 3 : 2);
            for ($j = 0; $j < $count; $j++) {
                $allKegiatan[] = KegiatanStatistik::create([
                    'dinas_id' => $dinas->id,
                    'nama'     => $namaKegiatan[$kegIdx % count($namaKegiatan)] . ' ' . $dinas->singkatan,
                    'jenis'    => $jenisOpsi[$kegIdx % 3],
                    'tahun'    => 2026,
                ]);
                $kegIdx++;
            }
        }

        // Earlier years (for bar chart history)
        $historyCounts = [2022 => 48, 2023 => 55, 2024 => 62, 2025 => 70];
        foreach ($historyCounts as $yr => $cnt) {
            for ($k = 0; $k < $cnt; $k++) {
                $d = $dinasList[$k % count($dinasList)];
                KegiatanStatistik::create([
                    'dinas_id' => $d->id,
                    'nama'     => $namaKegiatan[$k % count($namaKegiatan)] . ' ' . $d->singkatan . ' ' . $yr,
                    'jenis'    => $jenisOpsi[$k % 3],
                    'tahun'    => $yr,
                ]);
            }
        }

        // ──────────────────────────────────────────────
        // 4. Romantik for 2026 kegiatan
        // ──────────────────────────────────────────────
        $statusDinasOpts   = ['belum_diajukan', 'sudah_diajukan', 'sudah_diperbaiki'];
        $statusKominfoOpts = ['sedang_diperiksa', 'disetujui'];
        $statusBpsOpts     = ['sedang_diperiksa', 'perlu_perbaikan', 'disetujui'];

        foreach ($allKegiatan as $i => $keg) {
            // 60 sudah diajukan, 15 belum
            $sdinas = $i < 60 ? $statusDinasOpts[($i % 2) + 1] : 'belum_diajukan';
            $skom   = $i < 60 ? $statusKominfoOpts[$i % 2] : 'sedang_diperiksa';
            $sbps   = $i < 60 ? $statusBpsOpts[$i % 3] : 'sedang_diperiksa';

            Romantik::create([
                'kegiatan_id'        => $keg->id,
                'tahun'              => 2026,
                'status_dinas'       => $sdinas,
                'status_kominfo'     => $skom,
                'status_bps'         => $sbps,
                'tanggal_pengajuan'  => $i < 60 ? now()->subDays(rand(10, 90)) : null,
                'tanggal_persetujuan'=> $sbps === 'disetujui' ? now()->subDays(rand(1, 30)) : null,
            ]);
        }

        // ──────────────────────────────────────────────
        // 5. Metadata (3 types per kegiatan 2026)
        // ──────────────────────────────────────────────
        $metaJenis       = ['kegiatan', 'variabel', 'indikator'];
        $metaKomOpts     = ['belum_diajukan', 'draft', 'submit', 'sudah_diperbaiki', 'disetujui'];
        $metaBpsOpts     = ['sedang_diperiksa', 'perlu_perbaikan', 'disetujui'];

        // Metadata kegiatan: 45 sudah menyusun, 30 belum
        // Metadata variabel: 40 sudah, 35 belum
        // Metadata indikator: 38 sudah, 37 belum
        $thresholds = [45, 40, 38];

        foreach ($metaJenis as $jIdx => $jenis) {
            foreach ($allKegiatan as $i => $keg) {
                $done = $i < $thresholds[$jIdx];
                Metadata::create([
                    'kegiatan_id'    => $keg->id,
                    'jenis'          => $jenis,
                    'tahun'          => 2026,
                    'status_kominfo' => $done ? $metaKomOpts[rand(2, 4)] : $metaKomOpts[rand(0, 1)],
                    'status_bps'     => $done ? $metaBpsOpts[$i % 3] : 'sedang_diperiksa',
                ]);
            }
        }

        // ──────────────────────────────────────────────
        // 6. Aliran Data (37 data items, 25 sudah tayang, 12 belum)
        // ──────────────────────────────────────────────
        for ($a = 0; $a < 37; $a++) {
            $keg = $allKegiatan[$a % count($allKegiatan)];
            AliranData::create([
                'kegiatan_id'   => $keg->id,
                'nama_data'     => 'Data ' . ($a + 1) . ' — ' . $keg->nama,
                'tahun'         => 2026,
                'frekuensi'     => $a % 4 === 0 ? 'triwulanan' : 'tahunan',
                'sudah_tayang'  => $a < 25,
                'tanggal_tayang'=> $a < 25 ? now()->subDays(rand(5, 60)) : null,
            ]);
        }

        // ──────────────────────────────────────────────
        // 7. Monev (calendar entries for first 10 kegiatan)
        // ──────────────────────────────────────────────
        $statusMonev = ['tepat_waktu', 'terlambat', 'sedang_berjalan', 'belum_mulai'];
        foreach (array_slice($allKegiatan, 0, 10) as $i => $keg) {
            $mulai   = ($i % 12) + 1;
            $selesai = min($mulai + rand(1, 3), 12);
            $status  = $statusMonev[$i % 4];

            Monev::create([
                'kegiatan_id'           => $keg->id,
                'tahun'                 => 2026,
                'bulan_rencana_mulai'   => $mulai,
                'bulan_rencana_selesai' => $selesai,
                'bulan_realisasi_mulai' => in_array($status, ['tepat_waktu', 'terlambat', 'sedang_berjalan']) ? $mulai : null,
                'bulan_realisasi_selesai'=> $status === 'tepat_waktu' ? $selesai : ($status === 'terlambat' ? min($selesai + 1, 12) : null),
                'status'                => $status,
            ]);
        }

        // ──────────────────────────────────────────────
        // 8. Pembinaan & Presensi
        // ──────────────────────────────────────────────
        $pembinaanData = [
            ['judul' => 'Pembinaan Statistik Sektoral Triwulan I',  'tanggal' => '2026-02-15', 'deskripsi' => 'Forum pembinaan lintas OPD untuk harmonisasi indikator.'],
            ['judul' => 'Pembinaan Statistik Sektoral Triwulan II', 'tanggal' => '2026-05-14', 'deskripsi' => 'Forum pembinaan dihadiri 47 OPD se-Kabupaten Bantul.'],
        ];

        foreach ($pembinaanData as $pd) {
            $pembinaan = Pembinaan::create($pd);

            // Random attendance
            foreach ($dinasList as $dinas) {
                PresensiPembinaan::create([
                    'pembinaan_id' => $pembinaan->id,
                    'dinas_id'     => $dinas->id,
                    'hadir'        => rand(0, 100) < 80, // ~80% hadir
                ]);
            }
        }

        // ──────────────────────────────────────────────
        // 9. Berita Acara
        // ──────────────────────────────────────────────
        BeritaAcara::create([
            'judul'    => 'Pendampingan Kegiatan Statistik Dinsos 2026',
            'tanggal'  => '2026-05-20',
            'kategori' => 'pendampingan',
            'ringkasan'=> 'Tim BPS Bantul memberikan pendampingan teknis kepada Dinas Sosial dalam penyusunan rancangan kegiatan statistik tahun 2026.',
        ]);
        BeritaAcara::create([
            'judul'    => 'Pembinaan Statistik Sektoral Lintas OPD Triwulan II',
            'tanggal'  => '2026-05-14',
            'kategori' => 'pembinaan',
            'ringkasan'=> 'Forum pembinaan dihadiri 47 OPD se-Kabupaten Bantul untuk harmonisasi indikator pembangunan daerah.',
        ]);
        BeritaAcara::create([
            'judul'    => 'Coaching Clinic Penyusunan Romantik Bappeda',
            'tanggal'  => '2026-05-08',
            'kategori' => 'pendampingan',
            'ringkasan'=> 'Sesi pendampingan intensif penyusunan Rancangan Induk Kegiatan Statistik bersama Bappeda Kabupaten Bantul.',
        ]);
    }
}
