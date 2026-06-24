<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;

enum KategoriKegiatanPendampingan: string implements HasLabel, HasColor
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

    public function getLabel(): ?string
    {
        return $this->label();
    }

    public function getColor(): string | array | null
    {
        return $this->color();
    }
}
