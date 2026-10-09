<?php

namespace Database\Seeders;

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
        $password = env('SEED_DEFAULT_PASSWORD');

        if (blank($password)) {
            throw new RuntimeException('SEED_DEFAULT_PASSWORD belum diisi di file .env.');
        }

        $this->call(DinasSeeder::class);

        User::updateOrCreate(
            ['email' => 'admin@bpsbantul.com'],
            [
                'nama' => 'Admin BPS',
                'password' => $password,
                'role' => 'admin_bps',
                'id_dinas' => null,
            ],
        );

        foreach (Dinas::all() as $dinas) {
            User::updateOrCreate(
                ['email' => $dinas->slug.'@bpsbantul.com'],
                [
                    'nama' => $dinas->nama,
                    'password' => $password,
                    // Kominfo tetap terikat ke dinasnya, tetapi memakai tampilan pemeriksa Romantik/Metadata.
                    'role' => $dinas->slug === 'diskominfo' ? 'kominfo' : 'dinas',
                    'id_dinas' => $dinas->id,
                ],
            );
        }
    }
}
