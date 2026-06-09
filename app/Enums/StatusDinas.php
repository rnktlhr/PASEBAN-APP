<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;

enum StatusDinas: string implements HasLabel, HasColor
{
    case BELUM_DIAJUKAN = 'belum_diajukan';
    case SUDAH_DIAJUKAN = 'sudah_diajukan';
    case BELUM_DIPERBAIKI = 'belum_diperbaiki';
    case SUDAH_DIPERBAIKI = 'sudah_diperbaiki';

    public function label(): string
    {
        return match ($this) {
            self::BELUM_DIAJUKAN => 'Belum Diajukan',
            self::SUDAH_DIAJUKAN => 'Sudah Diajukan',
            self::BELUM_DIPERBAIKI => 'Belum Diperbaiki',
            self::SUDAH_DIPERBAIKI => 'Sudah Diperbaiki',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::BELUM_DIAJUKAN => 'gray',
            self::SUDAH_DIAJUKAN => 'success',
            self::BELUM_DIPERBAIKI => 'warning',
            self::SUDAH_DIPERBAIKI => 'success',
        };
    }

    /**
     * CSS color for public Blade views.
     */
    public function cssColor(): string
    {
        return match ($this) {
            self::SUDAH_DIAJUKAN, self::SUDAH_DIPERBAIKI => '#002B6A',
            default => '#EB891B',
        };
    }

    /**
     * CSS background for public Blade views.
     */
    public function cssBgColor(): string
    {
        return match ($this) {
            self::SUDAH_DIAJUKAN, self::SUDAH_DIPERBAIKI => '#eef2f6',
            default => 'rgba(235,137,27,.1)',
        };
    }

    /**
     * Status values that count as "sudah diajukan" for dashboard queries.
     */
    public static function submittedValues(): array
    {
        return [
            self::SUDAH_DIAJUKAN->value,
            self::SUDAH_DIPERBAIKI->value,
        ];
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

    public function getColor(): string | array | null
    {
        return $this->color();
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
