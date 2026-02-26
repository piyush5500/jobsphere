<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;

class EmployerDashboardController extends Controller
{
    /**
     * Display employer dashboard.
     */
    public function index()
    {
        $employerId = Auth::id();
        
        $stats = [
            'totalJobs' => Job::where('employer_id', $employerId)->count(),
            'totalApplications' => Application::whereHas('job', function ($query) use ($employerId) {
                $query->where('employer_id', $employerId);
            })->count(),
            'pendingApplications' => Application::whereHas('job', function ($query) use ($employerId) {
                $query->where('employer_id', $employerId);
            })->where('status', 'Pending')->count(),
        ];

        $recentJobs = Job::where('employer_id', $employerId)
            ->withCount('applications')
            ->latest()
            ->take(5)
            ->get();

        $recentApplications = Application::whereHas('job', function ($query) use ($employerId) {
            $query->where('employer_id', $employerId);
        })
        ->with(['job', 'user'])
        ->latest()
        ->take(5)
        ->get();

        return view('employer.dashboard', compact('stats', 'recentJobs', 'recentApplications'));
    }
}
