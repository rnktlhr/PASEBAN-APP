<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Isi tabel `settings` dari daftar default di config/paseban.php.
     * Nilai yang sudah pernah diubah Admin TIDAK akan ditimpa.
     */
    public function run(): void
    {
        foreach (config('paseban.settings', []) as $key => [$default, $type, $group, $description]) {
            Setting::firstOrCreate(
                ['key' => $key],
                [
                    'value' => $default,
                    'type' => $type,
                    'group' => $group,
                    'description' => $description,
                ],
            );
        }

        Setting::flushCache();
    }
}
