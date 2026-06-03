<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware; // Pastikan ini di-import atau sudah ada

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        // api: __DIR__.'/../routes/api.php', // Dikomentari jika file routes/api.php tidak ada atau tidak digunakan
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Pendaftaran Alias untuk Route Middleware
        $middleware->alias([
            'auth' => \Illuminate\Auth\Middleware\Authenticate::class, // Namespace bawaan Laravel
            'guest' => \Illuminate\Auth\Middleware\RedirectIfAuthenticated::class, // Namespace bawaan Laravel
            'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class, // Jika menggunakan verifikasi email

            // Alias untuk middleware IsAdmin Anda:
            'is.admin' => \App\Http\Middleware\IsAdmin::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Konfigurasi penanganan eksepsi
    })->create();
