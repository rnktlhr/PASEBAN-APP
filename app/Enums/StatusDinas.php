<?php

namespace App\Enums;

enum StatusDinas: string
{
    case BELUM_DIAJUKAN = 'belum_diajukan';
    case SUDAH_DIAJUKAN = 'sudah_diajukan';
    case BELUM_DIPERBAIKI = 'belum_diperbaiki';
    case SUDAH_DIPERBAIKI = 'sudah_diperbaiki';

    public function label(): string
    {
        return match ($this) {
            self::BELUM_DIAJUKAN => 'Belum Diajukan',
            self::SUDAH_DIAJUKAN => 'Sudah Diajukan',
            self::BELUM_DIPERBAIKI => 'Belum Diperbaiki',
            self::SUDAH_DIPERBAIKI => 'Sudah Diperbaiki',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(
            fn (self $case) => [$case->value => $case->label()]
        )->toArray();
    }
}
