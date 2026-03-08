<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Services\RoleSessionManager;

class MultiRoleAuthMiddleware
{
    protected RoleSessionManager $roleSessionManager;

    public function __construct(RoleSessionManager $roleSessionManager)
    {
        $this->roleSessionManager = $roleSessionManager;
    }

    /**
     * Handle an incoming request.
     * This middleware allows multiple role logins simultaneously using separate cookies
     */
    public function handle(Request $request, Closure $next, ?string $requiredRole = null)
    {
        // Check if any role is authenticated via our role session manager
        $authenticatedRoles = $this->roleSessionManager->getAuthenticatedRoles();
        
        // If still no authenticated roles, check default guards as fallback
        if (empty($authenticatedRoles)) {
            if (Auth::guard('web')->check()) {
                $user = Auth::guard('web')->user();
                $authenticatedRoles[] = $user->role ?? 'user';
            }
            if (Auth::guard('admin')->check()) {
                $authenticatedRoles[] = 'admin';
            }
        }
        
        // If still no authenticated roles, redirect to login (unless public route)
        if (empty($authenticatedRoles)) {
            if ($this->isPublicRoute($request)) {
                return $next($request);
            }
            
            // Check if trying to access admin area
            if ($request->is('admin/*') || $request->is('admin')) {
                return redirect()->route('admin.login');
            }
            
            return redirect()->route('login');
        }
        
        // If a specific role is required, check it
        if ($requiredRole) {
            if (!in_array($requiredRole, $authenticatedRoles)) {
                abort(403, 'Unauthorized - Required role: ' . $requiredRole);
            }
        }
        
        // Try to get the user from an authenticated role and set it for the request
        foreach ($authenticatedRoles as $role) {
            $user = $this->roleSessionManager->getUserForRole($role);
            if ($user) {
                // Set the user for the request so controllers can access it
                Auth::setUser($user);
                $request->attributes->set('current_role', $role);
                $request->attributes->set('auth_user', $user);
                break;
            }
        }
        
        return $next($request);
    }
    
    /**
     * Check if the request is for a public route
     */
    protected function isPublicRoute(Request $request): bool
    {
        $publicRoutes = [
            '/',
            '/login',
            '/register',
            '/admin/login',
            '/forgot-password',
            '/reset-password',
        ];
        
        $path = $request->path();
        
        if (in_array($path, $publicRoutes)) {
            return true;
        }
        
        // Check for patterns
        if ($request->is('jobs') || $request->is('jobs/*')) {
            return true;
        }
        
        if ($request->is('reset-password/*')) {
            return true;
        }
        
        if ($request->is('verify-email/*')) {
            return true;
        }
        
        return false;
    }
}
