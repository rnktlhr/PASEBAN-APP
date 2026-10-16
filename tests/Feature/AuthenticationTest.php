<?php

namespace Tests\Feature;

use App\Enums\Role;
use App\Models\Dinas;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    public function test_admin_can_access_admin_login_page(): void
    {
        $response = $this->get('/admin/login');
        $response->assertStatus(200);
    }

    public function test_dinas_can_access_dinas_login_page(): void
    {
        $response = $this->get('/dinas/login');
        $response->assertStatus(200);
    }

    public function test_root_login_redirects(): void
    {
        $response = $this->get('/login');
        $response->assertRedirect('/dinas/login');
    }

    public function test_admin_can_login_via_admin_panel(): void
    {
        $admin = User::where('role', Role::ADMIN_BPS)->first();
        if (!$admin) {
            $this->markTestSkipped('Admin user not found in database.');
        }

        filament()->setCurrentPanel(filament()->getPanel('admin'));

        \Livewire\Livewire::test(\Filament\Auth\Pages\Login::class)
            ->set('data.email', $admin->email)
            ->set('data.password', 'password123')
            ->call('authenticate')
            ->assertHasNoErrors()
            ->assertRedirect('/admin');

        $this->assertAuthenticatedAs($admin, 'admin');
    }

    public function test_dinas_user_can_login_via_dinas_panel(): void
    {
        $dinasUser = User::where('role', Role::DINAS)->first();
        if (!$dinasUser) {
            $this->markTestSkipped('Dinas user not found in database.');
        }

        filament()->setCurrentPanel(filament()->getPanel('dinas'));

        \Livewire\Livewire::test(\Filament\Auth\Pages\Login::class)
            ->set('data.email', $dinasUser->email)
            ->set('data.password', 'password123')
            ->call('authenticate')
            ->assertHasNoErrors();

        $this->assertAuthenticatedAs($dinasUser);
    }

    public function test_admin_cannot_login_via_dinas_panel(): void
    {
        $admin = User::where('role', Role::ADMIN_BPS)->first();
        if (!$admin) {
            $this->markTestSkipped('Admin user not found in database.');
        }

        filament()->setCurrentPanel(filament()->getPanel('dinas'));

        // Admin mencoba login di /dinas/login -> harus ditolak karena bukan panelnya
        \Livewire\Livewire::test(\Filament\Auth\Pages\Login::class)
            ->set('data.email', $admin->email)
            ->set('data.password', 'password123')
            ->call('authenticate')
            ->assertHasErrors();

        $this->assertGuest('web');
    }

    public function test_dinas_user_cannot_login_via_admin_panel(): void
    {
        $dinasUser = User::where('role', Role::DINAS)->first();
        if (!$dinasUser) {
            $this->markTestSkipped('Dinas user not found in database.');
        }

        filament()->setCurrentPanel(filament()->getPanel('admin'));

        // Akun dinas mencoba login di /admin/login -> harus ditolak
        \Livewire\Livewire::test(\Filament\Auth\Pages\Login::class)
            ->set('data.email', $dinasUser->email)
            ->set('data.password', 'password123')
            ->call('authenticate')
            ->assertHasErrors();

        $this->assertGuest('admin');
    }

    public function test_concurrent_login_admin_and_dinas(): void
    {
        $admin = User::where('role', Role::ADMIN_BPS)->first();
        $dinasUser = User::where('role', Role::DINAS)->first();
        $dinas = Dinas::find($dinasUser->id_dinas);

        // Login akun dinas di guard web
        auth('web')->login($dinasUser);
        // Login akun admin di guard admin secara bersamaan
        auth('admin')->login($admin);

        // Keduanya tetap terotentikasi di guard masing-masing
        $this->assertTrue(auth('web')->check(), 'Web guard should be authenticated');
        $this->assertTrue(auth('admin')->check(), 'Admin guard should be authenticated');
        $this->assertEquals($dinasUser->id, auth('web')->id());
        $this->assertEquals($admin->id, auth('admin')->id());

        // Request ke /admin menggunakan guard admin sukses 200
        $responseAdmin = $this->actingAs($admin, 'admin')->get('/admin');
        $this->assertEquals(200, $responseAdmin->status());

        // Request ke /dinas/{tenant} menggunakan guard web sukses 200
        $responseDinas = $this->actingAs($dinasUser, 'web')->get("/dinas/{$dinas->slug}");
        $this->assertEquals(200, $responseDinas->status());
    }
}
