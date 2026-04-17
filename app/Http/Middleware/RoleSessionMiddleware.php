<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleSessionMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ?string $role = null)
    {
        $user = $request->user();
        if ($role && (!$user || $user->role !== $role)) {
            abort(403, 'Unauthorized access for this role.');
        }

        return $next($request);
    }
}
