<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;

enum StatusMonev: string implements HasLabel, HasColor
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

    /**
     * CSS color for public Blade views.
     */
    public function cssColor(): string
    {
        return match ($this) {
            self::TEPAT_WAKTU => '#2e7d32',
            self::TERLAMBAT => 'var(--red)',
            self::SEDANG_BERJALAN => '#e67700',
            default => 'var(--muted)',
        };
    }

    /**
     * CSS background for public Blade views.
     */
    public function cssBgColor(): string
    {
        return match ($this) {
            self::TEPAT_WAKTU => '#e6f4ea',
            self::TERLAMBAT => 'var(--red-50)',
            self::SEDANG_BERJALAN => '#fff8e1',
            default => '#f5f5f5',
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

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
