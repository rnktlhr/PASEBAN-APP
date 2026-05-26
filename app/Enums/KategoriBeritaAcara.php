<?php

namespace App\Enums;

enum KategoriBeritaAcara: string
{
    case PENDAMPINGAN = 'pendampingan';
    case PEMBINAAN = 'pembinaan';

    public function label(): string
    {
        return match ($this) {
            self::PENDAMPINGAN => 'Pendampingan',
            self::PEMBINAAN => 'Pembinaan',
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
            self::PENDAMPINGAN => 'success',
            self::PEMBINAAN => 'primary',
        };
    }
}
