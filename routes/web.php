<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\EmployerDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Employer\JobController as EmployerJobController;
use App\Http\Controllers\JobController as PublicJobController;

// Public Jobs Routes
Route::get('/jobs', [PublicJobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{job}', [PublicJobController::class, 'show'])->name('jobs.show');

// Authentication Routes
require __DIR__.'/auth.php';

// Protected Routes
Route::middleware(['auth'])->group(function () {
    // Dashboard - redirects based on role
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif (auth()->user()->role === 'employer') {
            return redirect()->route('employer.dashboard');
        } else {
            return redirect()->route('user.dashboard');
        }
    })->middleware(['verified'])->name('dashboard');

    // User Routes (Job Seeker)
    Route::middleware(['role:user'])->group(function () {
        Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
        Route::get('/user/applications', [UserDashboardController::class, 'applications'])->name('user.applications');
        Route::post('/jobs/apply/{job}', [PublicJobController::class, 'apply'])->name('jobs.apply');
    });

    // Employer Routes
    Route::middleware(['role:employer'])->group(function () {
        Route::get('/employer/dashboard', [EmployerDashboardController::class, 'index'])->name('employer.dashboard');
        Route::get('/employer/jobs', [EmployerJobController::class, 'index'])->name('employer.jobs.index');
        Route::get('/employer/jobs/create', [EmployerJobController::class, 'create'])->name('employer.jobs.create');
        Route::post('/employer/jobs', [EmployerJobController::class, 'store'])->name('employer.jobs.store');
        Route::get('/employer/jobs/{job}/edit', [EmployerJobController::class, 'edit'])->name('employer.jobs.edit');
        Route::put('/employer/jobs/{job}', [EmployerJobController::class, 'update'])->name('employer.jobs.update');
        Route::delete('/employer/jobs/{job}', [EmployerJobController::class, 'destroy'])->name('employer.jobs.destroy');
        Route::get('/employer/jobs/{job}/applications', [EmployerJobController::class, 'applications'])->name('employer.jobs.applications');
        Route::post('/employer/applications/{application}/status', [EmployerJobController::class, 'updateStatus'])->name('employer.applications.updateStatus');
    });

    // Admin Routes
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/admin/users', [AdminDashboardController::class, 'users'])->name('admin.users');
        Route::get('/admin/users/{id}', [AdminDashboardController::class, 'showUser'])->name('admin.users.show');
        Route::get('/admin/jobs', [AdminDashboardController::class, 'jobs'])->name('admin.jobs');
        Route::get('/admin/jobs/{id}', [AdminDashboardController::class, 'showJob'])->name('admin.jobs.show');
        Route::get('/admin/applications', [AdminDashboardController::class, 'applications'])->name('admin.applications');
    });

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Welcome Page
Route::get('/', function () {
    return view('welcome');
});

// Admin Authentication Routes (Login only - no registration)
Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/admin/login', [AdminAuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});
