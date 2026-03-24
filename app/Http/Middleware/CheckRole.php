<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!auth()->check()) {
            abort(403);
        }

        // Si el usuario es administrador, puede acceder a todo
        if (auth()->user()->isAdmin()) {
            return $next($request);
        }

        // Si no es admin, comprobamos que tenga el rol exacto
        if (auth()->user()->role->name !== $role) {
            abort(403);
        }

        return $next($request);
    }
}
