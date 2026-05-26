<?php

namespace App\Enums;

enum StatusKominfo: string
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
}
