<?php

namespace App\Models;

use App\Enums\Role;
use App\Models\Concerns\LogsActivity;
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
    use LogsActivity;

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
            'role' => Role::class,
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
     * Kontrol hak akses masuk ke Filament Panel:
     * - Panel 'admin' eksklusif untuk Admin BPS (/admin).
     * - Panel 'dinas' eksklusif untuk Dinas, Kominfo, dan Bappeda (/dinas).
     */
    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() === 'admin') {
            return $this->isAdmin();
        }

        if ($panel->getId() === 'dinas') {
            return $this->hasRole(Role::DINAS, Role::KOMINFO, Role::BAPPEDA);
        }

        return false;
    }

    /**
     * Daftar tenant (Dinas) yang dapat diakses oleh user.
     * Wajib diimplementasikan karena DinasPanelProvider menggunakan multi-tenancy.
     */
    public function getTenants(Panel $panel): array|Collection
    {
        if ($this->hasRole(Role::KOMINFO, Role::BAPPEDA)) {
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
        if ($this->hasRole(Role::KOMINFO, Role::BAPPEDA)) {
            return true;
        }

        return (int) $this->id_dinas === (int) $tenant->id;
    }

    /**
     * Cek apakah user memiliki salah satu role yang diberikan.
     */
    public function hasRole(Role ...$roles): bool
    {
        $current = $this->role instanceof Role
            ? $this->role
            : Role::tryFrom((string) $this->role);

        return $current !== null && in_array($current, $roles, true);
    }

    public function isAdmin(): bool
    {
        return $this->hasRole(Role::ADMIN_BPS);
    }

    public function isKominfo(): bool
    {
        return $this->hasRole(Role::KOMINFO);
    }

    public function isDinas(): bool
    {
        return $this->hasRole(Role::DINAS);
    }

    public function isBappeda(): bool
    {
        return $this->hasRole(Role::BAPPEDA);
    }

    public function dinas(): BelongsTo
    {
        return $this->belongsTo(Dinas::class, 'id_dinas');
    }
}
