<?php

namespace App\Enums;

enum StatusBps: string
{
    case SEDANG_DIPERIKSA = 'sedang_diperiksa';
    case PERLU_PERBAIKAN = 'perlu_perbaikan';
    case DISETUJUI = 'disetujui';

    public function label(): string
    {
        return match ($this) {
            self::SEDANG_DIPERIKSA => 'Sedang Diperiksa',
            self::PERLU_PERBAIKAN => 'Perlu Perbaikan',
            self::DISETUJUI => 'Disetujui',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::SEDANG_DIPERIKSA => 'warning',
            self::PERLU_PERBAIKAN => 'danger',
            self::DISETUJUI => 'success',
        };
    }

    /**
     * CSS color for public Blade views.
     */
    public function cssColor(): string
    {
        return match ($this) {
            self::SEDANG_DIPERIKSA => '#EB891B',
            self::PERLU_PERBAIKAN => 'var(--red)',
            self::DISETUJUI => 'var(--green)',
        };
    }

    /**
     * CSS background for public Blade views.
     */
    public function cssBgColor(): string
    {
        return match ($this) {
            self::SEDANG_DIPERIKSA => 'rgba(235,137,27,.1)',
            self::PERLU_PERBAIKAN => 'rgba(220,53,69,.1)',
            self::DISETUJUI => '#e6f4ea',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(
            fn (self $case) => [$case->value => $case->label()]
        )->toArray();
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
