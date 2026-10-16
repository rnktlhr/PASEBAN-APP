<?php

/*
|--------------------------------------------------------------------------
| Pesan Sistem PASEBAN
|--------------------------------------------------------------------------
|
| Seluruh teks notifikasi / flash message / label sistem dipusatkan di sini
| agar seragam dan mudah diubah tanpa menyentuh Controller maupun View.
|
*/

return [

    'import' => [
        'success' => 'Import Berhasil',
        'success_body' => 'Data berhasil diimpor ke sistem.',
        'validation_failed' => 'Import Gagal (Validasi)',
        'failed' => 'Import Gagal',
        'failed_body' => 'Pastikan format file sesuai template. Error: :error',
        'row_error' => 'Baris :row: :errors',
        'more_errors' => '...dan :count error lainnya.',
        'download_template' => 'Download Template',
        'import_excel' => 'Import Excel',
        'choose_file' => 'Pilih File Excel',
    ],

    'crud' => [
        'created' => 'Data berhasil ditambahkan.',
        'updated' => 'Data berhasil diperbarui.',
        'deleted' => 'Data berhasil dihapus.',
        'failed' => 'Terjadi kesalahan, data gagal disimpan.',
    ],

    'settings' => [
        'title' => 'Pengaturan Sistem',
        'navigation' => 'Pengaturan Sistem',
        'saved' => 'Pengaturan berhasil disimpan.',
        'save' => 'Simpan Pengaturan',
        'groups' => [
            'aplikasi' => 'Identitas Aplikasi',
            'instansi' => 'Identitas Instansi',
            'tautan' => 'Tautan Eksternal',
        ],
    ],

    'audit' => [
        'title' => 'Jejak Audit',
        'navigation' => 'Jejak Audit',
        'model_label' => 'Log Aktivitas',
        'columns' => [
            'time' => 'Waktu',
            'user' => 'Pengguna',
            'action' => 'Aksi',
            'subject' => 'Objek',
            'description' => 'Keterangan',
            'ip' => 'Alamat IP',
            'user_agent' => 'Perangkat / Browser',
            'old_values' => 'Data Sebelum',
            'new_values' => 'Data Sesudah',
        ],
        'actions' => [
            'created' => 'Tambah',
            'updated' => 'Ubah',
            'deleted' => 'Hapus',
            'login' => 'Login',
            'logout' => 'Logout',
            'login_failed' => 'Login Gagal',
        ],
        'system' => 'Sistem',
        'login_failed_desc' => 'Percobaan login gagal untuk email: :email',
    ],

    'errors' => [
        'back_home' => 'Kembali ke Beranda',
        'back' => 'Kembali',
        'reload' => 'Muat Ulang Halaman',
        '403' => [
            'title' => 'Akses Ditolak',
            'message' => 'Maaf, Anda tidak memiliki hak akses untuk membuka halaman ini. Silakan hubungi administrator apabila Anda merasa ini adalah kesalahan.',
        ],
        '404' => [
            'title' => 'Halaman Tidak Ditemukan',
            'message' => 'Maaf, halaman yang Anda tuju tidak dapat ditemukan. Mungkin halaman tersebut telah dihapus atau Anda salah memasukkan URL.',
        ],
        '419' => [
            'title' => 'Sesi Kedaluwarsa',
            'message' => 'Sesi Anda telah berakhir karena terlalu lama tidak ada aktivitas. Silakan muat ulang halaman lalu ulangi kembali aksi Anda.',
        ],
        '429' => [
            'title' => 'Terlalu Banyak Permintaan',
            'message' => 'Anda mengirim terlalu banyak permintaan dalam waktu singkat. Silakan tunggu sebentar lalu coba lagi.',
        ],
        '500' => [
            'title' => 'Terjadi Kesalahan pada Server',
            'message' => 'Maaf, sistem kami sedang mengalami gangguan internal. Tim teknis kami telah diberitahu dan sedang berusaha memperbaikinya.',
        ],
        '503' => [
            'title' => 'Sedang Dalam Pemeliharaan',
            'message' => 'Sistem sedang menjalani pemeliharaan terjadwal untuk peningkatan layanan. Silakan kembali beberapa saat lagi.',
        ],
    ],

    'mail' => [
        'regards' => 'Salam,',
        'signature' => 'Admin :app - :org',
    ],

];
