<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;

enum JenisMetadata: string implements HasLabel, HasColor
{
    case KEGIATAN = 'kegiatan';
    case VARIABEL = 'variabel';
    case INDIKATOR = 'indikator';

    public function label(): string
    {
        return match ($this) {
            self::KEGIATAN => 'Metadata Kegiatan',
            self::VARIABEL => 'Metadata Variabel',
            self::INDIKATOR => 'Metadata Indikator',
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
            self::KEGIATAN => 'primary',
            self::VARIABEL => 'warning',
            self::INDIKATOR => 'success',
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
