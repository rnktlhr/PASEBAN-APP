<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Pengaturan Dinamis (Default)
    |--------------------------------------------------------------------------
    |
    | Nilai di bawah ini HANYA digunakan sebagai nilai awal (seed) dan
    | fallback apabila tabel `settings` belum tersedia. Nilai yang aktif
    | dikelola oleh Admin melalui menu "Pengaturan Sistem" di panel admin
    | dan dibaca menggunakan helper `setting('key')`.
    |
    | Format: 'key' => [default, type, group, label/deskripsi]
    |
    */

    'settings' => [
        // Identitas aplikasi
        'app_nama'          => [env('PASEBAN_APP_NAMA', 'PASEBAN'), 'string', 'aplikasi', 'Nama singkat aplikasi'],
        'app_kepanjangan'   => [env('PASEBAN_APP_KEPANJANGAN', 'Pemantauan Statistik Sektoral Bantul'), 'string', 'aplikasi', 'Kepanjangan / slogan aplikasi'],
        'app_deskripsi'     => [env('PASEBAN_APP_DESKRIPSI', 'Platform terpadu BPS Kabupaten Bantul untuk pemantauan, pembinaan, dan monitoring kegiatan statistik sektoral.'), 'text', 'aplikasi', 'Deskripsi singkat (meta description)'],

        // Identitas instansi
        'org_nama'          => [env('PASEBAN_ORG_NAMA', 'BPS Kabupaten Bantul'), 'string', 'instansi', 'Nama instansi pengelola'],
        'org_wilayah'       => [env('PASEBAN_ORG_WILAYAH', 'Kabupaten Bantul'), 'string', 'instansi', 'Nama wilayah / pemerintah daerah'],
        'org_alamat'        => [env('PASEBAN_ORG_ALAMAT', 'Jl. Gatot Subroto No. 3'), 'string', 'instansi', 'Alamat instansi'],
        'org_kota'          => [env('PASEBAN_ORG_KOTA', 'Bantul, DI Yogyakarta 55711'), 'string', 'instansi', 'Kota, provinsi, dan kode pos'],
        'org_telepon'       => [env('PASEBAN_ORG_TELEPON', '(0274) 367424'), 'string', 'instansi', 'Nomor telepon'],
        'org_email'         => [env('PASEBAN_ORG_EMAIL', 'bps3402@bps.go.id'), 'email', 'instansi', 'Alamat email resmi'],

        // Tautan eksternal
        'pedoman_url'       => [env('PEDOMAN_URL', 'https://bpsbantul.my.canva.site/pss2026'), 'url', 'tautan', 'URL pedoman / materi pembinaan'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache Pengaturan
    |--------------------------------------------------------------------------
    */

    'settings_cache_key' => 'app_settings',

    /*
    |--------------------------------------------------------------------------
    | Data Awal (Seeder)
    |--------------------------------------------------------------------------
    */

    'seed' => [
        'default_password' => env('SEED_DEFAULT_PASSWORD'),
        'email_domain' => env('SEED_EMAIL_DOMAIN', 'bpsbantul.com'),
        'kominfo_slug' => env('SEED_KOMINFO_SLUG', 'diskominfo'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Jejak Audit
    |--------------------------------------------------------------------------
    |
    | Atribut yang tidak boleh dicatat ke log (selain atribut $hidden model),
    | serta masa simpan log dalam hari (dipakai oleh `model:prune`).
    |
    */

    'audit' => [
        'excluded_attributes' => ['password', 'remember_token', 'updated_at', 'created_at'],
        'retention_days' => (int) env('PASEBAN_AUDIT_RETENTION_DAYS', 365),
    ],

    /*
    |--------------------------------------------------------------------------
    | Nama Bulan Indonesia
    |--------------------------------------------------------------------------
    */

    'bulan' => [
        1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr',
        5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Agu',
        9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des',
    ],

    'bulan_lengkap' => [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
    ],

    /*
    |--------------------------------------------------------------------------
    | Tahun Default & Range
    |--------------------------------------------------------------------------
    */

    'chart_year_range' => (int) env('PASEBAN_CHART_YEAR_RANGE', 5), // Jumlah tahun yang ditampilkan di bar chart

];
