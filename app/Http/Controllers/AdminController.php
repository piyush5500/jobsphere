<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Job;
use App\Models\Application;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function jobs()
    {
        $jobs = Job::with('employer')->get();
        return view('admin.jobs', compact('jobs'));
    }

    public function applications()
    {
        $applications = Application::with(['job', 'user'])->get();
        return view('admin.applications', compact('applications'));
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('success', 'User Deleted Successfully');
    }

    public function deleteJob($id)
    {
        $job = Job::findOrFail($id);
        $job->delete();
        return back()->with('success', 'Job Deleted Successfully');
    }

    public function deleteApplication($id)
    {
        $application = Application::findOrFail($id);
        $application->delete();
        return back()->with('success', 'Application Deleted Successfully');
    }
}
