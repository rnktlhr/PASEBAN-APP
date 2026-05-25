<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasTenants;
use Filament\Panel;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser, HasTenants
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'dinas_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // --- Role helpers ---

    public function isAdmin(): bool
    {
        return $this->role === 'admin_bps';
    }

    public function isKominfo(): bool
    {
        return $this->role === 'kominfo';
    }

    public function isDinas(): bool
    {
        return $this->role === 'dinas';
    }

    public function isBappeda(): bool
    {
        return $this->role === 'bappeda';
    }

    // --- Relationships ---

    public function dinas(): BelongsTo
    {
        return $this->belongsTo(Dinas::class);
    }

    // --- Filament ---

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    public function getTenants(Panel $panel): array|Collection
    {
        return $this->dinas ? [$this->dinas] : [];
    }

    public function canAccessTenant(Model $tenant): bool
    {
        return $this->dinas_id === $tenant->id;
    }
}
