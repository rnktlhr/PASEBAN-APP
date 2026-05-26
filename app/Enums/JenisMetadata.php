<?php

namespace App\Enums;

enum JenisMetadata: string
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
}
