<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class GuardedSessionMiddleware
{
    /**
     * Handle an incoming request.
     * This middleware maintains separate sessions for different guards using different cookies
     */
    public function handle(Request $request, Closure $next, string $guard = 'web')
    {
        // Get the cookie name for this guard
        $cookieName = $this->getCookieName($guard);
        
        // Check if we have a valid session cookie for this guard
        $sessionData = $this->getSessionData($guard);
        
        if ($sessionData) {
            // Set the user for this guard if session is valid
            $userId = $sessionData['user_id'] ?? null;
            $user = \App\Models\User::find($userId);
            
            if ($user) {
                // Use the appropriate guard
                Auth::guard($guard)->setUser($user);
            }
        }
        
        return $next($request);
    }
    
    /**
     * Get the cookie name for a guard
     */
    protected function getCookieName(string $guard): string
    {
        $cookies = [
            'web' => 'jobsphere_session',
            'admin' => 'jobsphere_admin_session',
            'employer' => 'jobsphere_employer_session',
            'user' => 'jobsphere_user_session',
        ];
        
        return $cookies[$guard] ?? 'jobsphere_session';
    }
    
    /**
     * Get session data from cookie
     */
    protected function getSessionData(string $guard): ?array
    {
        $cookieName = $this->getCookieName($guard);
        $encodedData = request()->cookie($cookieName);
        
        if (!$encodedData) {
            return null;
        }
        
        $data = json_decode(base64_decode($encodedData), true);
        
        if (!$data || !isset($data['expires']) || $data['expires'] < time()) {
            return null;
        }
        
        return $data;
    }
}
