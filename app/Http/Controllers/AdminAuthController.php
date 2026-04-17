<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

        $user = User::where('email', $request->email)->first();
        
        if ($user && Hash::check($request->password, $user->password) && $user->role === 'admin') {
            auth()->login($user);
            $request->session()->regenerate();
            
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
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}

