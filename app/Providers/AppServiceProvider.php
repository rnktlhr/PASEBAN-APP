<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
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
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // if (env('APP_ENV') !== 'local') {
        //     URL::forceScheme('https');
        // }

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
}
