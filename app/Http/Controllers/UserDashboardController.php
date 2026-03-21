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

        // Company-related data (if user has employer role or company association)
        $companyJobs = null;
        $companyApplications = null;
        $companyStats = null;

        // Check if user can manage company/employer features
        if ($user->role === 'employer' || $user->can_post_jobs ?? false) {
            $companyJobs = Job::where('user_id', $user->id)
                ->withCount('applications')
                ->latest()
                ->take(5)
                ->get();

            $companyStats = [
                'totalJobs' => Job::where('user_id', $user->id)->count(),
                'totalApplications' => Application::whereHas('job', function($q) use ($user) {
                    $q->where('user_id', $user->id);
                })->count(),
                'pendingApplications' => Application::whereHas('job', function($q) use ($user) {
                    $q->where('user_id', $user->id);
                })->where('status', 'Pending')->count(),
                'reviewedApplications' => Application::whereHas('job', function($q) use ($user) {
                    $q->where('user_id', $user->id);
                })->where('status', 'Reviewed')->count(),
                'hiredApplications' => Application::whereHas('job', function($q) use ($user) {
                    $q->where('user_id', $user->id);
                })->where('status', 'Hired')->count(),
            ];

            $companyApplications = Application::whereHas('job', function($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->with(['job', 'user'])
            ->latest()
            ->take(5)
            ->get();
        }

// Get company staff (if company has staff)
        $companyStaff = User::where('company_id', $user->id)
            ->orWhere('employer_id', $user->id)
            ->take(5)
            ->get();

        return view('user.dashboard', compact(
            'applications', 
            'totalApplications', 
            'availableJobs', 
            'resumeMissing',
            'profileCompletion',
            'profileCompletionItems',
            'companyJobs',
            'companyApplications',
'companyStats',
            'companyStaff'
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
