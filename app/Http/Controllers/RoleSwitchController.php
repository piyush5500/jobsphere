<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleSwitchController extends Controller
{
    public function switch(Request $request, $role)
    {
        $user = auth()->user();
        
        if (!$user || $user->role !== $role) {
            abort(403, 'No access to this role.');
        }
        
        $request->session()->put('active_role', $role);
        
        // Redirect to role dashboard
        $redirects = [
            'user' => '/user/dashboard',
            'employer' => '/employer/dashboard',
            'admin' => '/admin/dashboard'
        ];
        
        return redirect($redirects[$role] ?? '/dashboard');
    }
}

