<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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
        $user = Auth::user();

        // Check if job is active and accepting applications
        if (!$job->isApplicationOpen()) {
            return back()->with('error', 'This job is no longer accepting applications.');
        }

        // Require resume: profile resume OR uploaded file
        if (empty($user->resume) && !$request->hasFile('resume')) {
            return back()->with('error', 'A resume is required to apply for jobs. Please upload one in your profile settings or select a file here.');
        }

        // Validate resume upload if provided
        $request->validate([
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        // Check if user has already applied
        $existingApplication = Application::where('job_id', $job->id)
            ->where('user_id', Auth::id())
            ->first();

        if ($existingApplication) {
            return back()->with('error', 'You have already applied for this job.');
        }

    $application = Application::create([
        'job_id' => $job->id,
        'user_id' => Auth::id(),
        'status' => 'Pending',
    ]);

    // Handle resume upload if provided
    if ($request->hasFile('resume')) {
        $resumeFile = $request->file('resume');
        $filename = time() . '_' . $resumeFile->getClientOriginalName();
        $path = $resumeFile->storeAs('applications/resumes', $filename, 'public');
        $application->resume = $path;
        $application->save();
    }

    return back()->with('success', 'Application submitted successfully! Check your applications dashboard.');
}
}
