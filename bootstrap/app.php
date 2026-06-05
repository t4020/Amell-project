<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [
            \App\Http\Middleware\RequestDebugLogging::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->renderable(function (Throwable $e) {
            if ($e instanceof HttpExceptionInterface && $e->getStatusCode() === 403) {
                $request = request();
                $user = $request->user();

                Log::warning('HTTP 403', [
                    'url' => $request->fullUrl(),
                    'method' => $request->method(),
                    'route' => $request->route()?->getName(),
                    'route_params' => $request->route()?->parameters() ?? [],
                    'auth_user_id' => $user?->id,
                    'auth_user_role' => $user?->role,
                    'exception' => get_class($e),
                    'message' => $e->getMessage(),
                ]);
            }

            return null;
        });
    })->create();
