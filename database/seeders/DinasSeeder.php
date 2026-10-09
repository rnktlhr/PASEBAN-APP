<?php

namespace Database\Seeders;

use App\Models\Dinas;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DinasSeeder extends Seeder
{
    /**
     * Daftar unit kerja produsen data dari file Identifikasi Kegiatan Statistik
     * Sektoral OPD Bantul 2025 & 2026 (BPS Kabupaten Bantul).
     * instansi_code mengikuti kode instansi pada API Sedata Sebantul.
     * Slug (alamat URL panel OPD) dibuat dari singkatan.
     */
    public const DATA = [
        // [nama, singkatan, instansi_code]
        ['Dinas Pendidikan, Kepemudaan dan Olahraga', 'Disdikpora', '10100'],
        ['Dinas Kesehatan', 'Dinkes', '10200'],
        ['Dinas Pekerjaan Umum, Perumahan dan Kawasan Permukiman', 'DPUPKP', '10300'],
        ['Dinas Pertanahan dan Tata Ruang (Kundha Niti Mandala Sarta Tata Sasana)', 'Dispertaru', '10400'],
        ['Badan Perencanaan Pembangunan Daerah', 'Bappeda', '10500'],
        ['Dinas Perhubungan', 'Dishub', '10700'],
        ['Dinas Lingkungan Hidup', 'DLH', '10800'],
        ['Dinas Kependudukan dan Pencatatan Sipil', 'Disdukcapil', '10900'],
        ['Dinas Sosial', 'Dinsos', '11000'],
        ['Dinas Tenaga Kerja dan Transmigrasi', 'Disnakertrans', '11100'],
        ['Dinas Koperasi, Usaha Kecil dan Menengah, Perindustrian dan Perdagangan', 'DKUKMPP', '11200'],
        ['Satuan Polisi Pamong Praja', 'Satpol PP', '11300'],
        ['Badan Kesatuan Bangsa dan Politik', 'Kesbangpol', '11400'],
        ['Sekretariat Dewan Perwakilan Rakyat Daerah', 'Setwan', '11500'],
        ['Bagian Tata Pemerintahan Sekretariat Daerah', 'Bag. Tapem', '11701'],
        ['Bagian Kesejahteraan Rakyat Sekretariat Daerah', 'Bag. Kesra', '11702'],
        ['Bagian Hukum Sekretariat Daerah', 'Bag. Hukum', '11703'],
        ['Bagian Perekonomian Pembangunan dan Sumber Daya Alam Sekretariat Daerah', 'Bag. Perekonomian', '11704'],
        ['Bagian Pengadaan Barang dan Jasa Sekretariat Daerah', 'Bag. PBJ', '11705'],
        ['Bagian Umum dan Protokol Sekretariat Daerah', 'Bag. Umpro', '11706'],
        ['Bagian Organisasi Sekretariat Daerah', 'Bag. Organisasi', '11707'],
        ['Bagian Perencanaan dan Keuangan Sekretariat Daerah', 'Bag. Renkeu', '11708'],
        ['Dinas Kelautan dan Perikanan', 'DKP', '11800'],
        ['Badan Pengelolaan Keuangan, Pendapatan dan Aset Daerah', 'BKPAD', '11900'],
        ['Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu', 'DPMPTSP', '12000'],
        ['Inspektorat Daerah', 'Inspektorat', '12100'],
        ['Badan Kepegawaian dan Pengembangan Sumberdaya Manusia', 'BKPSDM', '12200'],
        ['Badan Penanggulangan Bencana Daerah', 'BPBD', '12300'],
        ['Dinas Pemberdayaan Perempuan dan Perlindungan Anak, Pengendalian Penduduk dan Keluarga Berencana', 'DP3AP2KB', '12400'],
        ['Dinas Komunikasi dan Informatika', 'Diskominfo', '12500'],
        ['Dinas Perpustakaan dan Kearsipan', 'Dispusip', '12600'],
        ['Dinas Ketahanan Pangan dan Pertanian', 'DKPP', '12700'],
        ['Dinas Pariwisata', 'Dispar', '12800'],
        ['Dinas Kebudayaan (Kundha Kabudayan)', 'Disbud', '12900'],
        ['Dinas Pemberdayaan Masyarakat dan Kalurahan', 'DPMK', '13000'],
        ['RSUD Panembahan Senopati', 'RSUD PS', '13500'],
    ];

    public function run(): void
    {
        foreach (self::DATA as [$nama, $singkatan, $instansiCode]) {
            Dinas::updateOrCreate(
                ['instansi_code' => $instansiCode],
                [
                    'nama' => $nama,
                    'singkatan' => $singkatan,
                    'slug' => Str::slug($singkatan),
                ],
            );
        }
    }
}
