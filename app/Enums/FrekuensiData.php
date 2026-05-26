<?php

namespace App\Enums;

enum FrekuensiData: string
{
    case TRIWULANAN = 'triwulanan';
    case TAHUNAN = 'tahunan';

    public function label(): string
    {
        return match ($this) {
            self::TRIWULANAN => 'Triwulanan',
            self::TAHUNAN => 'Tahunan',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(
            fn (self $case) => [$case->value => $case->label()]
        )->toArray();
    }
}
