<?php

namespace App\Http\Middleware;

use App\Services\RoleSessionManager;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SwitchSessionForRole
{
    /**
     * Handle an incoming request.
     * Switches session cookie based on the role being accessed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        // Simply pass through - the route's role middleware will handle authorization
        return $next($request);
    }
}
