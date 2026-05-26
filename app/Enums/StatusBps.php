<?php

namespace App\Enums;

enum StatusBps: string
{
    case SEDANG_DIPERIKSA = 'sedang_diperiksa';
    case PERLU_PERBAIKAN = 'perlu_perbaikan';
    case DISETUJUI = 'disetujui';

    public function label(): string
    {
        return match ($this) {
            self::SEDANG_DIPERIKSA => 'Sedang Diperiksa',
            self::PERLU_PERBAIKAN => 'Perlu Perbaikan',
            self::DISETUJUI => 'Disetujui',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(
            fn (self $case) => [$case->value => $case->label()]
        )->toArray();
    }
}
