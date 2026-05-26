<?php

namespace App\Enums;

enum StatusMonev: string
{
    case BELUM_MULAI = 'belum_mulai';
    case SEDANG_BERJALAN = 'sedang_berjalan';
    case TEPAT_WAKTU = 'tepat_waktu';
    case TERLAMBAT = 'terlambat';

    public function label(): string
    {
        return match ($this) {
            self::BELUM_MULAI => 'Belum Mulai',
            self::SEDANG_BERJALAN => 'Sedang Berjalan',
            self::TEPAT_WAKTU => 'Tepat Waktu',
            self::TERLAMBAT => 'Terlambat',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(
            fn (self $case) => [$case->value => $case->label()]
        )->toArray();
    }

    public function color(): string
    {
        return match ($this) {
            self::BELUM_MULAI => 'gray',
            self::SEDANG_BERJALAN => 'warning',
            self::TEPAT_WAKTU => 'success',
            self::TERLAMBAT => 'danger',
        };
    }
}
