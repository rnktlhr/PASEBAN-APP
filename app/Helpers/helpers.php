<?php

use App\Models\Setting;

if (! function_exists('setting')) {
    /**
     * Ambil nilai pengaturan dinamis aplikasi.
     *
     * Contoh: setting('org_nama'), setting('pedoman_url', '#')
     */
    function setting(string $key, mixed $default = null): mixed
    {
        return Setting::get($key, $default);
    }
}

if (! function_exists('parse_relative_time_to_minutes')) {
    /**
     * Konversi teks waktu relatif bahasa Indonesia (misal: "4 jam yang lalu", "3 minggu yang lalu")
     * menjadi estimasi angka menit untuk keperluan pengurutan (sorting) dari yang terbaru.
     */
    function parse_relative_time_to_minutes(?string $str): int
    {
        if (!$str || trim($str) === '-' || trim($str) === '') {
            return PHP_INT_MAX;
        }

        $str = strtolower(trim($str));

        if (preg_match('/(\d+)\s*(detik|menit|jam|hari|minggu|bulan|tahun)/i', $str, $matches)) {
            $val = (int) $matches[1];
            $unit = $matches[2];

            return match ($unit) {
                'detik' => (int) ($val / 60),
                'menit' => $val,
                'jam' => $val * 60,
                'hari' => $val * 1440,
                'minggu' => $val * 10080,
                'bulan' => $val * 43200,
                'tahun' => $val * 525600,
                default => PHP_INT_MAX - 1,
            };
        }

        return PHP_INT_MAX;
    }
}
