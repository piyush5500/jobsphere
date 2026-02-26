<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    /**
     * Display a listing of all jobs.
     */
    public function index(Request $request)
    {
        $query = Job::with('employer')->latest();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        if ($request->has('job_type') && $request->job_type) {
            $query->where('job_type', $request->job_type);
        }

        if ($request->has('location') && $request->location) {
            $query->where('location', 'like', "%{$request->location}%");
        }

        $jobs = $query->paginate(10);
        
        return view('jobs.index', compact('jobs'));
    }

    /**
     * Display the specified job.
     */
    public function show(Job $job)
    {
        $job->load('employer');
        
        // Check if the user has already applied
        $hasApplied = false;
        if (Auth::check()) {
            $hasApplied = Application::where('job_id', $job->id)
                ->where('user_id', Auth::id())
                ->exists();
        }
        
        return view('jobs.show', compact('job', 'hasApplied'));
    }

    /**
     * Handle job application.
     */
    public function apply(Request $request, Job $job)
    {
        // Check if user has already applied
        $existingApplication = Application::where('job_id', $job->id)
            ->where('user_id', Auth::id())
            ->first();

        if ($existingApplication) {
            return back()->with('error', 'You have already applied for this job.');
        }

        Application::create([
            'job_id' => $job->id,
            'user_id' => Auth::id(),
            'status' => 'Pending',
        ]);

        return back()->with('success', 'Application submitted successfully!');
    }
}
