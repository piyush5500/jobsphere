<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\RoleSessionManager;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        // Store the role in the session
        $user = Auth::user();
        
        // Always regenerate session to create a unique session for this role
        // This ensures each role has its own session ID stored in role-specific cookie
        $request->session()->regenerate();
        
        $request->session()->put('role', $user->role);

        // Store role-specific session - this saves the NEW session ID to a role-specific cookie
        RoleSessionManager::storeRoleSession($user->role);

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $role = $request->session()->get('role');
        
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // Clear role-specific session if role was stored
        if ($role) {
            RoleSessionManager::clearRoleSession($role);
        }

        return redirect('/');
    }
}
