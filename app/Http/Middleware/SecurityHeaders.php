<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Prevent clickjacking
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // Prevent MIME type sniffing
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // XSS Protection (legacy browsers)
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        // Referrer Policy
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // Permissions Policy (disable dangerous features)
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=(), payment=()');

        // Prevent cross-domain Flash/PDF loading
        $response->headers->set('X-Permitted-Cross-Domain-Policies', 'none');

        $csp = [
            "default-src 'self'",
            "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.jsdelivr.net https://unpkg.com",
            "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com",
            "font-src 'self' https://fonts.gstatic.com",
            "img-src 'self' data: blob: https://ui-avatars.com",
            "connect-src 'self' https://cdn.jsdelivr.net",
            "frame-ancestors 'self'",
        ];

        // Always allow Vite dev server (localhost) to prevent CSP issues during local development
        $viteHosts = "http://localhost:5173 http://127.0.0.1:5173";
        $viteWs = "ws://localhost:5173 ws://127.0.0.1:5173";
        $csp[1] .= " " . $viteHosts;
        $csp[2] .= " " . $viteHosts;
        $csp[4] .= " " . $viteHosts;
        $csp[5] .= " " . $viteHosts . " " . $viteWs;

        $response->headers->set('Content-Security-Policy', implode('; ', $csp));

        // HSTS (only in production with HTTPS)
        if (app()->environment('production')) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
        }

        return $response;
    }
}
