<?php

namespace App\Http\Responses;

use Filament\Auth\Http\Responses\Contracts\LoginResponse as LoginResponseContract;
use Filament\Facades\Filament;
use Illuminate\Http\RedirectResponse;
use Livewire\Features\SupportRedirects\Redirector;

/**
 * Pengalihan setelah login:
 * - Login di Panel Admin (/admin/login) -> selalu mengarah ke Dashboard Admin (/admin).
 * - Login di Panel Dinas (/dinas/login) -> selalu mengarah ke Dashboard Dinas (/dinas/{tenant}).
 * Tidak ada pengalihan silang antar panel.
 */
class LoginResponse implements LoginResponseContract
{
    public function toResponse($request): RedirectResponse | Redirector
    {
        $panel = Filament::getCurrentOrDefaultPanel();

        // 1. Panel Admin (/admin/login)
        if ($panel->getId() === 'admin') {
            return redirect()->intended($panel->getUrl());
        }

        // 2. Panel Dinas (/dinas/login)
        $user = Filament::auth()->user();
        $tenant = Filament::getUserDefaultTenant($user);

        if ($tenant) {
            return redirect()->intended($panel->getUrl($tenant));
        }

        return redirect()->intended($panel->getUrl());
    }
}
