<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Register middleware aliases
        $middleware->alias([
            'admin' => \App\Http\Middleware\IsAdmin::class,
            'csrf' => \App\Http\Middleware\VerifyCsrfToken::class,
        ]);

        // Define the web middleware group, including CSRF
        $middleware->group('web', [
            \Illuminate\Cookie\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            'csrf', // Include CSRF middleware here via the alias
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);
    })    
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
