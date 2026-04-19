<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Application;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    /**
     * Display user/company dashboard.
     */
    public function index()
    {
        $user = Auth::user();

        // Check if user has uploaded a resume
        $resumeMissing = empty($user->resume);

        // Get user's applications (for job seekers)
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

        // Get profile completion data
        $profileCompletion = $user->profile_completion;
        $profileCompletionItems = $user->getProfileCompletionItems();

        // Company-related data (optimized: reduced queries)
        $companyJobs = null;
        $companyApplications = null;
        $companyStats = null;

        // Check if user can manage company/employer features
        if ($user->role === 'employer' || $user->can_post_jobs ?? false) {
            $companyJobs = Job::where('employer_id', $user->id)
                ->withCount('applications')
                ->latest()
                ->take(5)
                ->get();

            $statusCounts = Application::whereHas('job', function($q) use ($user) {
                $q->where('employer_id', $user->id);
            })->selectRaw('status, count(*) as cnt')
                ->groupBy('status')
                ->pluck('cnt', 'status')
                ->toArray();

            $companyStats = [
                'totalJobs' => $companyJobs->count(),
                'totalApplications' => array_sum($statusCounts),
                'pendingApplications' => $statusCounts['Pending'] ?? 0,
                'reviewedApplications' => $statusCounts['Reviewed'] ?? 0,
                'hiredApplications' => $statusCounts['Hired'] ?? 0,
            ];

            $companyApplications = Application::whereHas('job', function($q) use ($user) {
                $q->where('employer_id', $user->id);
            })
                ->with(['job.employer', 'user'])
                ->latest()
                ->take(5)
                ->get();
        }

return view('user.dashboard', compact(
            'applications', 
            'totalApplications', 
            'availableJobs', 
            'resumeMissing',
            'profileCompletion',
            'profileCompletionItems',
            'companyJobs',
            'companyApplications',
            'companyStats'
        ));
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
