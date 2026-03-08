<?php

namespace App\Services;

use Illuminate\Session\SessionManager as BaseSessionManager;

class GuardSessionManager extends BaseSessionManager
{
    /**
     * Get the session cookie name for a specific guard
     */
    public function getCookieNameForGuard(string $guard): string
    {
        $guardConfig = config('session.guards.' . $guard);
        
        if ($guardConfig && isset($guardConfig['cookie'])) {
            return $guardConfig['cookie'];
        }
        
        // Default cookie names
        $defaultCookies = [
            'web' => 'jobsphere_session',
            'admin' => 'jobsphere_admin_session',
            'employer' => 'jobsphere_employer_session',
            'user' => 'jobsphere_user_session',
        ];
        
        return $defaultCookies[$guard] ?? 'jobsphere_session';
    }
    
    /**
     * Create a new session store for a specific guard
     */
    public function getSessionForGuard(string $guard)
    {
        $cookieName = $this->getCookieNameForGuard($guard);
        
        // Store the original cookie name
        $originalCookie = config('session.cookie');
        
        // Temporarily change the cookie name for this session
        config(['session.cookie' => $cookieName]);
        
        // Get the session
        $session = $this->driver();
        
        // Restore original cookie name
        config(['session.cookie' => $originalCookie]);
        
        return $session;
    }
}
