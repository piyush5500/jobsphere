<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    /**
     * Display user dashboard.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get user's applications
        $applications = Application::where('user_id', $user->id)
            ->with('job')
            ->latest()
            ->take(5)
            ->get();
        
        // Get total application count
        $totalApplications = Application::where('user_id', $user->id)->count();
        
        // Get available jobs for browsing
        $availableJobs = Job::with('employer')
            ->latest()
            ->take(5)
            ->get();

        return view('user.dashboard', compact('applications', 'totalApplications', 'availableJobs'));
    }

    /**
     * Display user's all applications.
     */
    public function applications()
    {
        $applications = Application::where('user_id', Auth::id())
            ->with(['job.employer'])
            ->latest()
            ->paginate(10);

        return view('user.applications', compact('applications'));
    }
}
