# PASEBAN APP - Deployment Guide

Aplikasi PASEBAN (Platform Terpadu BPS Kabupaten Bantul) dibangun menggunakan Laravel dan Filament. Berikut adalah checklist penting saat melakukan *deployment* ke *server production*.

## Checklist Deployment (Production)

Pastikan konfigurasi di file `.env` di server telah disesuaikan:

1. **Environment & Debugging:**
   ```env
   APP_ENV=production
   APP_DEBUG=false
   ```
   > **PENTING:** Jangan pernah mengatur `APP_DEBUG=true` di server *live* untuk mencegah kebocoran kredensial dan struktur database.

2. **Keamanan URL & HTTPS:**
   Aplikasi **WAJIB** dijalankan menggunakan HTTPS (sertifikat SSL aktif).
   ```env
   APP_URL=https://domain-anda.go.id
   SESSION_SECURE_COOKIE=true
   ```

3. **Generate App Key:**
   Jalankan perintah berikut untuk mengamankan enkripsi data:
   ```bash
   php artisan key:generate
   ```

4. **Peringatan Seeder:**
   Setelah menjalankan `php artisan migrate --seed`, pastikan Anda **segera mengganti password** default untuk akun Superadmin (`admin_bps`) dan akun-akun OPD melalui panel admin. Default password yang ada di seeder tidak aman untuk digunakan di production.

5. **Optimasi Cache:**
   Jalankan perintah berikut untuk mempercepat performa aplikasi di *production*:
   ```bash
   php artisan optimize
   php artisan view:cache
   php artisan filament:optimize
   ```

6. **Storage Link:**
   Pastikan folder penyimpanan terhubung agar file unggahan bisa diakses secara publik (khusus berita acara):
   ```bash
   php artisan storage:link
   ```

---
*Dikembangkan oleh Badan Pusat Statistik Kabupaten Bantul.*
