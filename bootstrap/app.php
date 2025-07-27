<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        api: __DIR__ . '/../routes/api.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->api(prepend: [ // Asegúrate de que este sea el grupo 'api'
            EnsureFrontendRequestsAreStateful::class, // ¡Esta línea es crucial!
        ]);

        // Si también utilizas autenticación de sesión para API, asegura que StartSession esté en el grupo web:
        $middleware->web(append: [
            StartSession::class,
            ShareErrorsFromSession::class,
            VerifyCsrfToken::class, // <-- ¡Aquí está el cambio!
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
