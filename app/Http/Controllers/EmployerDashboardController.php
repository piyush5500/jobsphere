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
        
        // Optimized: Single query for all stats
        $jobCount = Job::where('employer_id', $employerId)->count();
        
        $appStats = Application::whereHas('job', function ($query) use ($employerId) {
                $query->where('employer_id', $employerId);
            })
            ->selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $stats = [
            'totalJobs' => $jobCount,
            'totalApplications' => array_sum($appStats),
            'pendingApplications' => $appStats['Pending'] ?? 0,
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
