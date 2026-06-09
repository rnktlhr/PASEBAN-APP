<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;

enum StatusKominfo: string implements HasLabel, HasColor
{
    case BELUM_DIAJUKAN = 'belum_diajukan';
    case DRAFT = 'draft';
    case SUBMIT = 'submit';
    case SEDANG_DIPERIKSA = 'sedang_diperiksa';
    case SUDAH_DIPERBAIKI = 'sudah_diperbaiki';
    case DISETUJUI = 'disetujui';

    public function label(): string
    {
        return match ($this) {
            self::BELUM_DIAJUKAN => 'Belum Diajukan',
            self::DRAFT => 'Draft',
            self::SUBMIT => 'Submit',
            self::SEDANG_DIPERIKSA => 'Sedang Diperiksa',
            self::SUDAH_DIPERBAIKI => 'Sudah Diperbaiki',
            self::DISETUJUI => 'Disetujui',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(
            fn (self $case) => [$case->value => $case->label()]
        )->toArray();
    }

    /**
     * Subset untuk Metadata (tanpa sedang_diperiksa).
     */
    public static function metadataOptions(): array
    {
        return collect([
            self::BELUM_DIAJUKAN,
            self::DRAFT,
            self::SUBMIT,
            self::SUDAH_DIPERBAIKI,
            self::DISETUJUI,
        ])->mapWithKeys(fn (self $case) => [$case->value => $case->label()])->toArray();
    }

    /**
     * Subset untuk Romantik (hanya 2 opsi).
     */
    public static function romantikOptions(): array
    {
        return collect([
            self::SEDANG_DIPERIKSA,
            self::DISETUJUI,
        ])->mapWithKeys(fn (self $case) => [$case->value => $case->label()])->toArray();
    }

    public function color(): string
    {
        return match ($this) {
            self::BELUM_DIAJUKAN => 'gray',
            self::DRAFT => 'gray',
            self::SUBMIT => 'info',
            self::SEDANG_DIPERIKSA => 'warning',
            self::SUDAH_DIPERBAIKI => 'warning',
            self::DISETUJUI => 'success',
        };
    }

    /**
     * CSS color for public Blade views.
     */
    public function cssColor(): string
    {
        return match ($this) {
            self::DISETUJUI, self::SUBMIT, self::SUDAH_DIPERBAIKI => '#002B6A',
            self::DRAFT => '#94a3b8',
            default => '#EB891B',
        };
    }

    /**
     * CSS background for public Blade views.
     */
    public function cssBgColor(): string
    {
        return match ($this) {
            self::DISETUJUI, self::SUBMIT, self::SUDAH_DIPERBAIKI => '#eef2f6',
            self::DRAFT => 'rgba(148,163,184,.15)',
            default => 'rgba(235,137,27,.1)',
        };
    }

    /**
     * Status values that count as "completed/done" for dashboard progress queries.
     */
    public static function completedValues(): array
    {
        return [
            self::SUBMIT->value,
            self::SUDAH_DIPERBAIKI->value,
            self::DISETUJUI->value,
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
