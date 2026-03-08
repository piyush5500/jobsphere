<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleSessionMiddleware
{
    /**
     * Handle an incoming request.
     * This middleware ensures each role uses its own session cookie
     */
    public function handle(Request $request, Closure $next, ?string $role = null)
    {
        // If a role is specified, check session role first (allows multiple role logins)
        if ($role) {
            $sessionRole = $request->session()->get('role');
            
            if ($sessionRole) {
                // Use session role
                if ($sessionRole !== $role) {
                    abort(403, 'Unauthorized access for this role.');
                }
            } elseif ($request->user()) {
                // Fall back to user role if no session role
                if ($request->user()->role !== $role) {
                    abort(403, 'Unauthorized access for this role.');
                }
            }
        }

        return $next($request);
    }
}
