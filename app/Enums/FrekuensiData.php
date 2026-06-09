<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum FrekuensiData: string implements HasLabel
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

    public function getLabel(): ?string
    {
        return $this->label();
    }
}
