<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;

enum JenisKegiatan: string implements HasLabel, HasColor
{
    case SURVEI = 'survei';
    case PENDATAAN_LENGKAP = 'pendataan_lengkap';
    case KOMPROMIN = 'kompromin';

    public function label(): string
    {
        return match ($this) {
            self::SURVEI => 'Survei',
            self::PENDATAAN_LENGKAP => 'Pendataan Lengkap',
            self::KOMPROMIN => 'Kompilasi Produk Administrasi (Kompromin)',
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
            self::SURVEI => 'primary',
            self::PENDATAAN_LENGKAP => 'success',
            self::KOMPROMIN => 'warning',
        };
    }

    /**
     * CSS color for public Blade views.
     */
    public function cssColor(): string
    {
        return match ($this) {
            self::SURVEI => 'var(--teal)',
            self::PENDATAAN_LENGKAP => 'var(--green)',
            self::KOMPROMIN => 'var(--orange)',
        };
    }

    /**
     * CSS background for public Blade views.
     */
    public function cssBgColor(): string
    {
        return match ($this) {
            self::SURVEI => 'var(--teal-50)',
            self::PENDATAAN_LENGKAP => '#e6f4ea',
            self::KOMPROMIN => 'var(--orange-50)',
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
