<?php

namespace App\Http\Controllers;

use App\Services\RoleSessionManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AdminAuthController extends Controller
{
    /**
     * Display the admin login view.
     */
    public function showLoginForm(): View
    {
        return view('admin.login');
    }

    /**
     * Handle an incoming admin login request.
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt to login with admin role only
        if (Auth::attempt(array_merge($credentials, ['role' => 'admin']))) {
            // Always regenerate session to create a unique session for this role
            // This ensures each role has its own session ID stored in role-specific cookie
            $request->session()->regenerate();
            
            // Store the admin role in session
            $request->session()->put('role', 'admin');
            
            // Store role-specific session - this saves the NEW session ID to a role-specific cookie
            RoleSessionManager::storeRoleSession('admin');
            
            return redirect()->intended('/admin/dashboard')->with('success', 'Welcome back, Admin!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our admin records.',
        ])->withInput($request->except('password'));
    }

    /**
     * Logout the admin.
     */
    public function logout(Request $request): RedirectResponse
    {
        $role = $request->session()->get('role');
        
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Clear role-specific session if role was stored
        if ($role) {
            RoleSessionManager::clearRoleSession($role);
        }

        return redirect('/admin/login');
    }
}
