<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\Dinas;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use RuntimeException;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Data awal: daftar dinas, 1 akun Admin BPS, dan 1 akun untuk tiap dinas.
     * Password seluruh akun diambil dari SEED_DEFAULT_PASSWORD di .env.
     */
    public function run(): void
    {
        $password = config('paseban.seed.default_password');
        $domain = config('paseban.seed.email_domain');
        $kominfoSlug = config('paseban.seed.kominfo_slug');

        if (blank($password)) {
            throw new RuntimeException('SEED_DEFAULT_PASSWORD belum diisi di file .env.');
        }

        $this->call([
            SettingSeeder::class,
            DinasSeeder::class,
        ]);

        User::updateOrCreate(
            ['email' => "admin@{$domain}"],
            [
                'nama' => Role::ADMIN_BPS->label(),
                'password' => $password,
                'role' => Role::ADMIN_BPS,
                'id_dinas' => null,
            ],
        );

        foreach (Dinas::all() as $dinas) {
            User::updateOrCreate(
                ['email' => "{$dinas->slug}@{$domain}"],
                [
                    'nama' => $dinas->nama,
                    'password' => $password,
                    // Kominfo tetap terikat ke dinasnya, tetapi memakai tampilan pemeriksa Romantik/Metadata.
                    'role' => $dinas->slug === $kominfoSlug ? Role::KOMINFO : Role::DINAS,
                    'id_dinas' => $dinas->id,
                ],
            );
        }
    }
}
