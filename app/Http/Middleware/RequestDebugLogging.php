<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RequestDebugLogging
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        $route = $request->route();

        $context = [
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'ip' => $request->ip(),
            'route' => $route?->getName(),
            'route_params' => $route?->parameters() ?? [],
            'auth_user_id' => $user?->id,
            'auth_user_role' => $user?->role,
        ];

        Log::debug('HTTP request', $context);

        $response = $next($request);

        Log::debug('HTTP response', $context + [
            'status' => $response->getStatusCode(),
        ]);

        return $response;
    }
}

