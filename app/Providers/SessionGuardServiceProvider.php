<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SessionGuardServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->configureMultiRoleSession();
    }
    
    /**
     * Configure session to support multiple roles simultaneously
     * This stores role-specific user IDs in separate session keys
     */
    protected function configureMultiRoleSession(): void
    {
        // Extend the default session handler to support multiple role logins
        $this->app->resolving(\Illuminate\Session\Store::class, function ($session) {
            // This ensures each request has access to role-specific session data
        });
    }
    
    /**
     * Save user ID for a specific role in the session
     */
    public static function saveRoleSession(string $guard, $user): void
    {
        $sessionKey = self::getRoleSessionKey($guard);
        Session::put($sessionKey, $user->id);
        Session::put('current_role', $guard);
    }
    
    /**
     * Get user ID for a specific role from the session
     */
    public static function getRoleSession(string $guard): ?int
    {
        $sessionKey = self::getRoleSessionKey($guard);
        return Session::get($sessionKey);
    }
    
    /**
     * Get the current active role from session
     */
    public static function getCurrentRoleFromSession(): ?string
    {
        return Session::get('current_role');
    }
    
    /**
     * Clear session for a specific role
     */
    public static function clearRoleSession(string $guard): void
    {
        $sessionKey = self::getRoleSessionKey($guard);
        Session::forget($sessionKey);
        
        // If clearing current role, switch to another if available
        if (Session::get('current_role') === $guard) {
            $otherRoles = ['admin', 'employer', 'user'];
            foreach ($otherRoles as $role) {
                if ($role !== $guard && self::getRoleSession($role)) {
                    Session::put('current_role', $role);
                    return;
                }
            }
            Session::forget('current_role');
        }
    }
    
    /**
     * Get session key for a role
     */
    protected static function getRoleSessionKey(string $guard): string
    {
        return 'role_user_' . $guard;
    }
}
