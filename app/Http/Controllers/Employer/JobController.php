<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    /**
     * Display a listing of employer's jobs.
     */
    public function index()
    {
        $jobs = Job::where('employer_id', Auth::id())
            ->withCount('applications')
            ->latest()
            ->get();
        
        return view('employer.jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new job.
     */
    public function create()
    {
        return view('employer.jobs.create');
    }

    /**
     * Store a newly created job.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'salary' => 'nullable|string|max:255',
            'job_type' => 'required|in:Full-time,Part-time,Contract,Internship',
        ]);

        Job::create([
            'employer_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'salary' => $request->salary,
            'job_type' => $request->job_type,
        ]);

        return redirect()->route('employer.jobs.index')
            ->with('success', 'Job posted successfully!');
    }

    /**
     * Show the form for editing the specified job.
     */
    public function edit($id)
    {
        $job = Job::where('employer_id', Auth::id())->findOrFail($id);
        
        return view('employer.jobs.edit', compact('job'));
    }

    /**
     * Update the specified job.
     */
    public function update(Request $request, $id)
    {
        $job = Job::where('employer_id', Auth::id())->findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'salary' => 'nullable|string|max:255',
            'job_type' => 'required|in:Full-time,Part-time,Contract,Internship',
        ]);

        $job->update([
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'salary' => $request->salary,
            'job_type' => $request->job_type,
        ]);

        return redirect()->route('employer.jobs.index')
            ->with('success', 'Job updated successfully!');
    }

    /**
     * Remove the specified job.
     */
    public function destroy($id)
    {
        $job = Job::where('employer_id', Auth::id())->findOrFail($id);
        $job->delete();

        return redirect()->route('employer.jobs.index')
            ->with('success', 'Job deleted successfully!');
    }

    /**
     * Display applications for a specific job.
     */
    public function applications($id)
    {
        $job = Job::where('employer_id', Auth::id())
            ->with(['applications.user'])
            ->findOrFail($id);
        
        return view('employer.jobs.applications', compact('job'));
    }

    /**
     * Update application status.
     */
    public function updateStatus(Request $request, $applicationId)
    {
        $application = Application::whereHas('job', function ($query) {
            $query->where('employer_id', Auth::id());
        })->findOrFail($applicationId);

        $request->validate([
            'status' => 'required|in:Applied,Pending,Reviewed,Shortlisted,Rejected,Hired',
        ]);

        $application->update(['status' => $request->status]);

        return back()->with('success', 'Application status updated successfully!');
    }
}
