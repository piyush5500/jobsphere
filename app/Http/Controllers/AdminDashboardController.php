<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Job;
use App\Models\Application;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    /**
     * Display admin dashboard.
     */
    public function index()
    {
        $stats = [
            'totalUsers' => User::count(),
            'totalJobs' => Job::count(),
            'totalApplications' => Application::count(),
            'totalEmployers' => User::where('role', 'employer')->count(),
            'totalJobSeekers' => User::where('role', 'user')->count(),
            'activeJobs' => Job::count(),
        ];

        $recentApplications = Application::with(['user', 'job'])
            ->latest()
            ->take(5)
            ->get();

        $recentJobs = Job::with('employer')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentApplications', 'recentJobs'));
    }

    /**
     * Display all users.
     */
    public function users()
    {
        $users = User::latest()->paginate(20);
        return view('admin.users', compact('users'));
    }

    /**
     * Display all jobs.
     */
    public function jobs()
    {
        $jobs = Job::with('employer')->latest()->paginate(20);
        return view('admin.jobs', compact('jobs'));
    }

    /**
     * Display all applications.
     */
    public function applications()
    {
        $applications = Application::with(['user', 'job.employer'])
            ->latest()
            ->paginate(20);
        return view('admin.applications', compact('applications'));
    }

    /**
     * Display user details.
     */
    public function showUser($id)
    {
        $user = User::with(['jobs', 'applications'])->findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Display all jobseekers.
     */
    public function jobseekers()
    {
        $jobseekers = User::where('role', 'user')->latest()->paginate(20);
        return view('admin.jobseekers', compact('jobseekers'));
    }

    /**
     * Display job details.
     */
    public function showJob($id)
    {
        $job = Job::with(['employer', 'applications.user'])->findOrFail($id);
        return view('admin.jobs.show', compact('job'));
    }
}
