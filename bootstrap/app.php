<?php

// use Illuminate\Foundation\Application;
// use Illuminate\Foundation\Configuration\Exceptions;
// use Illuminate\Foundation\Configuration\Middleware;
// use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
// use Illuminate\Session\Middleware\StartSession;
// use Illuminate\View\Middleware\ShareErrorsFromSession;
// use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;

// return Application::configure(basePath: dirname(__DIR__))
//     ->withRouting(
//         web: __DIR__ . '/../routes/web.php',
//         commands: __DIR__ . '/../routes/console.php',
//         api: __DIR__ . '/../routes/api.php',
//         health: '/up',
//     )
//     ->withMiddleware(function (Middleware $middleware): void {
//         $middleware->statefulApi();

//         // Si también utilizas autenticación de sesión para API, asegura que StartSession esté en el grupo web:
//         $middleware->web(append: [
//             StartSession::class,
//             ShareErrorsFromSession::class,
//             VerifyCsrfToken::class, // <-- ¡Aquí está el cambio!
//         ]);
//     })
//     ->withExceptions(function (Exceptions $exceptions): void {
//         //
//     })->create();

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
// No necesitas importar EnsureFrontendRequestsAreStateful, StartSession, ShareErrorsFromSession, VerifyCsrfToken
// si solo los usas a través de los helpers de middleware o en el grupo 'web' por defecto.

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        api: __DIR__ . '/../routes/api.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // La función statefulApi() automáticamente añade EnsureFrontendRequestsAreStateful
        // al grupo 'api' y se encarga de que la sesión se inicie para dominios stateful.
        // NO necesitas añadir StartSession, AuthenticateSession, etc., aquí manualmente para el grupo 'api'.
        $middleware->statefulApi();

        // El grupo 'web' mantiene sus middlewares estándar.
        // Asegúrate de que los middlewares de sesión, cookies y CSRF estén aquí.
        $middleware->web(append: [
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class, // Este es opcional y solo si lo necesitas para seguridad adicional en el grupo web.
            // Si lo tienes, asegúrate de que no cause problemas con otras configuraciones.
        ]);

        // Puedes añadir middlewares específicos para el grupo 'api' si son necesarios,
        // pero NO los middlewares de sesión/autenticación que ya se manejan con statefulApi().
        // Por ejemplo, si necesitas un middleware de CORS globalmente para la API:
        $middleware->api(prepend: [
            \Illuminate\Http\Middleware\HandleCors::class, // Asegúrate de que HandleCors se ejecute temprano
        ]);

        // Si tienes otros middlewares globales que no son específicos de 'web' o 'api',
        // puedes añadirlos aquí:
        // $middleware->alias([
        //     'abilities' => \Laravel\Sanctum\Http\Middleware\CheckAbilities::class,
        //     'ability' => \Laravel\Sanctum\Http\Middleware\CheckForAnyAbility::class,
        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
