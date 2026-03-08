<?php

namespace App\Services;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class RoleSessionManager
{
    /**
     * Get the session cookie name for a specific role
     */
    public static function getCookieName(string $role): string
    {
        return 'jobsphere_' . $role . '_session';
    }

    /**
     * Switch to a different role's session
     * Returns true if a session was switched, false otherwise
     */
    public static function switchToRole(string $role): bool
    {
        $cookieName = self::getCookieName($role);
        
        // Get the session ID from the role-specific cookie
        $sessionId = Cookie::get($cookieName);
        
        if ($sessionId) {
            // Save current session data first
            $currentData = $_SESSION ?? [];
            unset($_SESSION);
            
            // Set the session ID for this role
            Session::setId($sessionId);
            
            // Start the session with the role-specific ID
            Session::start();
            
            return true;
        }
        
        return false;
    }

    /**
     * Store the current session ID in a role-specific cookie
     */
    public static function storeRoleSession(string $role): void
    {
        $cookieName = self::getCookieName($role);
        $sessionId = Session::getId();
        
        // Store the session ID in a cookie that lasts for 2 weeks
        Cookie::queue($cookieName, $sessionId, 120 * 24 * 7); // 2 weeks
    }

    /**
     * Clear the role-specific session
     */
    public static function clearRoleSession(string $role): void
    {
        $cookieName = self::getCookieName($role);
        Cookie::queue(Cookie::forget($cookieName));
    }
}
