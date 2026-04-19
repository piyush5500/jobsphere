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
        $user = $request->user();
if (!$user || $user->role !== $role) {
\Log::error('RoleMiddleware block: user_id=' . ($user ? $user->id : 'null') . ', user_role=' . ($user ? $user->role : 'null') . ', required_role=' . $role . ', url=' . request()->url());
            return redirect()->route('dashboard')->with('error', 'Access denied. Required role: ' . $role . '. Redirected to dashboard.');
        }
        
        // Block inactive employers
        if ($user->isEmployer() && !$user->isActive()) {
            abort(403, 'Your account is currently paused or inactive. Please contact admin.');
        }

        return $next($request);
    }
}

