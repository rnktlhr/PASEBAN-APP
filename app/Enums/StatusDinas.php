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
    case BELUM_MENYUSUN = 'belum_menyusun';
    case SUDAH_MENYUSUN = 'sudah_menyusun';

    public function label(): string
    {
        return match ($this) {
            self::BELUM_DIAJUKAN => 'Belum Diajukan',
            self::SUDAH_DIAJUKAN => 'Sudah Diajukan',
            self::BELUM_DIPERBAIKI => 'Belum Diperbaiki',
            self::SUDAH_DIPERBAIKI => 'Sudah Diperbaiki',
            self::BELUM_MENYUSUN => 'Belum Menyusun',
            self::SUDAH_MENYUSUN => 'Sudah Menyusun',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::BELUM_DIAJUKAN, self::BELUM_MENYUSUN => 'gray',
            self::SUDAH_DIAJUKAN, self::SUDAH_MENYUSUN => 'success',
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
            self::SUDAH_DIAJUKAN, self::SUDAH_DIPERBAIKI, self::SUDAH_MENYUSUN => '#002B6A',
            default => '#EB891B',
        };
    }

    /**
     * CSS background for public Blade views.
     */
    public function cssBgColor(): string
    {
        return match ($this) {
            self::SUDAH_DIAJUKAN, self::SUDAH_DIPERBAIKI, self::SUDAH_MENYUSUN => '#eef2f6',
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
            self::SUDAH_MENYUSUN->value,
        ];
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(
            fn (self $case) => [$case->value => $case->label()]
        )->toArray();
    }

    /**
     * Subset opsi khusus untuk Romantik.
     */
    public static function romantikOptions(): array
    {
        return [
            self::BELUM_DIAJUKAN->value => self::BELUM_DIAJUKAN->label(),
            self::SUDAH_DIAJUKAN->value => self::SUDAH_DIAJUKAN->label(),
            self::BELUM_DIPERBAIKI->value => self::BELUM_DIPERBAIKI->label(),
            self::SUDAH_DIPERBAIKI->value => self::SUDAH_DIPERBAIKI->label(),
        ];
    }

    /**
     * Subset opsi khusus untuk Metadata (sesuai enum DB: belum_menyusun, sudah_menyusun).
     */
    public static function metadataOptions(): array
    {
        return [
            self::BELUM_MENYUSUN->value => self::BELUM_MENYUSUN->label(),
            self::SUDAH_MENYUSUN->value => self::SUDAH_MENYUSUN->label(),
        ];
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
