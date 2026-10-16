<?php

namespace App\Providers;

use App\Models\ActivityLog;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(
            \Filament\Auth\Http\Responses\Contracts\LoginResponse::class,
            \App\Http\Responses\LoginResponse::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (! $this->app->environment('local')) {
            URL::forceScheme('https');
        }

        $this->registerAuditListeners();

        // Throttle API requests: max 60 per minute per user/IP
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        // Throttle login attempts: max 5 per minute per IP
        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by($request->ip());
        });

        // Throttle export downloads: max 10 per minute per IP
        RateLimiter::for('exports', function (Request $request) {
            return Limit::perMinute(10)->by($request->ip());
        });
    }

    /**
     * Catat aktivitas autentikasi (Login, Logout, Login Gagal) ke jejak audit.
     */
    protected function registerAuditListeners(): void
    {
        Event::listen(Login::class, function (Login $event) {
            ActivityLog::record(ActivityLog::ACTION_LOGIN, $event->user, userId: $event->user->getAuthIdentifier());
        });

        Event::listen(Logout::class, function (Logout $event) {
            if ($event->user) {
                ActivityLog::record(ActivityLog::ACTION_LOGOUT, $event->user, userId: $event->user->getAuthIdentifier());
            }
        });

        Event::listen(Failed::class, function (Failed $event) {
            ActivityLog::record(
                ActivityLog::ACTION_LOGIN_FAILED,
                description: __('messages.audit.login_failed_desc', ['email' => $event->credentials['email'] ?? '-']),
                userId: $event->user?->getAuthIdentifier(),
            );
        });
    }
}
