<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\EmployerDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Employer\JobController as EmployerJobController;
use App\Http\Controllers\JobController as PublicJobController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ChatController;

// Public Jobs Routes
Route::get('/jobs', [PublicJobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{job}', [PublicJobController::class, 'show'])->name('jobs.show');

// Welcome Page
Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
require __DIR__.'/auth.php';

// Admin Authentication Routes (separate login page - outside auth middleware)
Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/admin/login', [AdminAuthController::class, 'login']);
});

// Protected Routes
Route::middleware(['auth'])->group(function () {
    // Dashboard - redirects based on role
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user) {
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'employer') {
                return redirect()->route('employer.dashboard');
            } else {
                return redirect()->route('user.dashboard');
            }
        }
        return redirect()->route('login');
    })->middleware(['verified'])->name('dashboard');

    // User Routes (Job Seeker) - with role-specific session
    Route::middleware(['role.session:user'])->group(function () {
        Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
        Route::get('/user/applications', [UserDashboardController::class, 'applications'])->name('user.applications');
        Route::post('/jobs/apply/{job}', [PublicJobController::class, 'apply'])->name('jobs.apply');
    });

    // Employer Routes - with role-specific session
    Route::middleware(['role.session:employer'])->group(function () {
        Route::get('/employer/dashboard', [EmployerDashboardController::class, 'index'])->name('employer.dashboard');
        Route::get('/employer/jobs', [EmployerJobController::class, 'index'])->name('employer.jobs.index');
        Route::get('/employer/jobs/create', [EmployerJobController::class, 'create'])->name('employer.jobs.create');
        Route::post('/employer/jobs', [EmployerJobController::class, 'store'])->name('employer.jobs.store');
        Route::get('/employer/jobs/{job}/edit', [EmployerJobController::class, 'edit'])->name('employer.jobs.edit');
        Route::put('/employer/jobs/{job}', [EmployerJobController::class, 'update'])->name('employer.jobs.update');
        Route::delete('/employer/jobs/{job}', [EmployerJobController::class, 'destroy'])->name('employer.jobs.destroy');
        Route::get('/employer/jobs/{job}/applications', [EmployerJobController::class, 'applications'])->name('employer.jobs.applications');
        Route::post('/employer/applications/{application}/status', [EmployerJobController::class, 'updateStatus'])->name('employer.applications.updateStatus');
        Route::patch('/employer/applications/{application}/status', [EmployerJobController::class, 'updateStatus'])->name('employer.applications.updateStatus');
    });

    // Admin Routes - with role-specific session
    Route::middleware(['role.session:admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/admin/users', [AdminDashboardController::class, 'users'])->name('admin.users');
        Route::get('/admin/users/{id}', [AdminDashboardController::class, 'showUser'])->name('admin.users.show');
        Route::get('/admin/jobseekers', [AdminDashboardController::class, 'jobseekers'])->name('admin.jobseekers');
        Route::post('/admin/jobseekers/{id}/toggle-status', [AdminController::class, 'toggleJobseekerStatus'])->name('admin.jobseekers.toggleStatus');
        Route::delete('/admin/jobseekers/{id}', [AdminController::class, 'deleteJobseeker'])->name('admin.jobseekers.destroy');
        Route::get('/admin/jobs', [AdminDashboardController::class, 'jobs'])->name('admin.jobs');
        Route::get('/admin/jobs/{id}', [AdminDashboardController::class, 'showJob'])->name('admin.jobs.show');
        Route::get('/admin/applications', [AdminDashboardController::class, 'applications'])->name('admin.applications');
    });

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Chat Routes
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/users', [ChatController::class, 'getUsers'])->name('chat.users');
    Route::get('/chat/{user}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/{user}', [ChatController::class, 'store'])->name('chat.store');
    Route::get('/chat/start/{user}', [ChatController::class, 'startConversation'])->name('chat.start');

    // Admin logout
    Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});

// Admin Employee Management Routes (protected by role middleware)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/employees', [EmployeeController::class, 'index'])->name('admin.employees.index');
    Route::get('/admin/employees/create', [EmployeeController::class, 'create'])->name('admin.employees.create');
    Route::post('/admin/employees', [EmployeeController::class, 'store'])->name('admin.employees.store');
    Route::get('/admin/employees/{id}', [EmployeeController::class, 'show'])->name('admin.employees.show');
    Route::get('/admin/employees/{id}/edit', [EmployeeController::class, 'edit'])->name('admin.employees.edit');
    Route::put('/admin/employees/{id}', [EmployeeController::class, 'update'])->name('admin.employees.update');
    Route::delete('/admin/employees/{id}', [EmployeeController::class, 'destroy'])->name('admin.employees.destroy');
    Route::post('/admin/employees/{id}/toggle-status', [EmployeeController::class, 'toggleStatus'])->name('admin.employees.toggleStatus');
});
