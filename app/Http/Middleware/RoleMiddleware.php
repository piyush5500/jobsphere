<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $role)
    {
        // Check if user is authenticated
        if (!$request->user()) {
            abort(403);
        }

        // Check role from session first (this is set during login per role)
        // Fall back to user role if session role not set
        $sessionRole = $request->session()->get('role');
        
        if ($sessionRole) {
            // Use session role - this allows multiple role logins in different tabs
            if ($sessionRole !== $role) {
                abort(403);
            }
        } else {
            // Fall back to user role if no session role
            if ($request->user()->role !== $role) {
                abort(403);
            }
        }

        return $next($request);
    }
}
