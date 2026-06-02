<?php

namespace App\Enums;

enum Role: string
{
    case ADMIN_BPS = 'admin_bps';
    case KOMINFO = 'kominfo';
    case DINAS = 'dinas';
    case BAPPEDA = 'bappeda';

    public function label(): string
    {
        return match ($this) {
            self::ADMIN_BPS => 'Admin BPS',
            self::KOMINFO => 'Kominfo',
            self::DINAS => 'Dinas',
            self::BAPPEDA => 'Bappeda',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::ADMIN_BPS => 'danger',
            self::KOMINFO => 'warning',
            self::DINAS => 'primary',
            self::BAPPEDA => 'gray',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(
            fn (self $case) => [$case->value => $case->label()]
        )->toArray();
    }

    /**
     * All enum values as a flat array (useful for validation rules).
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
