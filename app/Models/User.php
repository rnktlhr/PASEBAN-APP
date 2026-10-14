<?php

namespace App\Models;

use App\Enums\Role;
use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Models\Contracts\HasTenants;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;

class User extends Authenticatable implements HasName, FilamentUser, HasTenants
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'nama',
        'email',
        'password',
        'role',
        'id_dinas',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /**
     * Nama tampilan untuk Filament Panel (karena kolom database adalah `nama`, bukan `name`).
     */
    public function getFilamentName(): string
    {
        return $this->nama ?? 'Pengguna';
    }

    /**
     * Kontrol hak akses masuk ke Filament Panel.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    /**
     * Daftar tenant (Dinas) yang dapat diakses oleh user.
     * Wajib diimplementasikan karena DinasPanelProvider menggunakan multi-tenancy.
     */
    public function getTenants(Panel $panel): array|Collection
    {
        if ($this->isAdmin() || $this->isKominfo()) {
            return Dinas::all();
        }

        if ($this->dinas) {
            return collect([$this->dinas]);
        }

        $dinas = Dinas::find($this->id_dinas);
        return $dinas ? collect([$dinas]) : collect();
    }

    /**
     * Validasi apakah user berhak mengakses tenant (Dinas) tertentu.
     */
    public function canAccessTenant(Model $tenant): bool
    {
        if ($this->isAdmin() || $this->isKominfo()) {
            return true;
        }

        return (int) $this->id_dinas === (int) $tenant->id;
    }

    public function isAdmin(): bool
    {
        $r = $this->role instanceof Role ? $this->role->value : $this->role;
        return $r === 'admin_bps';
    }

    public function isKominfo(): bool
    {
        $r = $this->role instanceof Role ? $this->role->value : $this->role;
        return $r === 'kominfo';
    }

    public function isDinas(): bool
    {
        $r = $this->role instanceof Role ? $this->role->value : $this->role;
        return $r === 'dinas';
    }

    public function isBappeda(): bool
    {
        $r = $this->role instanceof Role ? $this->role->value : $this->role;
        return $r === 'bappeda';
    }

    public function dinas(): BelongsTo
    {
        return $this->belongsTo(Dinas::class, 'id_dinas');
    }
}
