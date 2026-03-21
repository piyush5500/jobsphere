<x-app-layout>
    <div class="company-dashboard dashboard-container">
        <!-- Welcome Banner -->
        <div class="welcome-banner">
            <div>
                <h2>Welcome back, {{ auth()->user()->name }}!</h2>
                <p>Manage your company, track job postings, and review applications.</p>
            </div>
            @if($companyStats)
            <a href="{{ route('employer.jobs.create') }}" class="banner-action">Post New Job</a>
            @else
            <a href="{{ route('jobs.index') }}" class="banner-action">Browse Jobs</a>
            @endif
        </div>

        <!-- Two Column Layout -->
        <div class="two-column">
            <!-- Main Content -->
            <div>
                <!-- Stats Cards -->
                <div class="stats-grid">
                    @if($companyStats)
                    <!-- Company Stats -->
                    <div class="stat-card stat-card-primary">
                        <div class="stat-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H5V5zm2 4H5v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-value">{{ $companyStats['totalJobs'] }}</h3>
                            <p class="stat-label">Company Jobs</p>
                        </div>
                    </div>

                    <div class="stat-card stat-card-success">
                        <div class="stat-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-value">{{ $companyStats['totalApplications'] }}</h3>
                            <p class="stat-label">Total Applications</p>
                        </div>
                    </div>

                    <div class="stat-card stat-card-warning">
                        <div class="stat-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-value">{{ $companyStats['pendingApplications'] }}</h3>
                            <p class="stat-label">Pending Review</p>
                        </div>
                    </div>

                    <div class="stat-card stat-card-info">
                        <div class="stat-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-value">{{ $companyStats['hiredApplications'] }}</h3>
                            <p class="stat-label">Hired</p>
                        </div>
                    </div>
@else
                    <!-- Company User Stats -->
                    <div class="stat-card stat-card-primary">
                        <div class="stat-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-value">{{ $totalApplications }}</h3>
                            <p class="stat-label">Total Applications</p>
                        </div>
                    </div>

                    <div class="stat-card stat-card-warning">
                        <div class="stat-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-value">{{ $applications->where('status', 'Pending')->count() }}</h3>
                            <p class="stat-label">Pending</p>
                        </div>
                    </div>

                    <div class="stat-card stat-card-success">
                        <div class="stat-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-value">{{ $applications->where('status', 'Hired')->count() }}</h3>
                            <p class="stat-label">Hired</p>
                        </div>
                    </div>

                    <div class="stat-card stat-card-info">
                        <div class="stat-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-value">{{ $applications->where('status', 'Reviewed')->count() }}</h3>
                            <p class="stat-label">Reviewed</p>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Company Hiring Pipeline (if company stats exist) -->
                @if($companyStats)
                <div class="pipeline-section">
                    <h3>Hiring Pipeline</h3>
                    <div class="pipeline-stages">
                        <div class="pipeline-stage">
                            <div class="stage-count">{{ $companyStats['totalApplications'] }}</div>
                            <div class="stage-label">Total</div>
                            <div class="stage-bar"></div>
                        </div>
                        <div class="pipeline-stage">
                            <div class="stage-count">{{ $companyStats['pendingApplications'] }}</div>
                            <div class="stage-label">Pending</div>
                            <div class="stage-bar" style="background: var(--classic-warning);"></div>
                        </div>
                        <div class="pipeline-stage">
                            <div class="stage-count">{{ $companyStats['reviewedApplications'] }}</div>
                            <div class="stage-label">Reviewed</div>
                            <div class="stage-bar" style="background: var(--classic-accent);"></div>
                        </div>
                        <div class="pipeline-stage">
                            <div class="stage-count">{{ $companyStats['hiredApplications'] }}</div>
                            <div class="stage-label">Hired</div>
                            <div class="stage-bar" style="background: var(--classic-success);"></div>
                        </div>
                    </div>
                </div>
                @else
                <!-- Application Timeline (for job seekers) -->
                <div class="application-timeline">
                    <h3>Application Status Timeline</h3>
                    <div class="app-timeline">
                        @forelse($applications->take(5) as $application)
                        <div class="app-timeline-item">
                            <div class="timeline-dot {{ strtolower($application->status) }}"></div>
                            <div class="timeline-content">
                                <div class="job-title">{{ $application->job->title }}</div>
                                <div class="status-text">
                                    Status: <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $application->status)) }}">{{ $application->status }}</span>
                                </div>
                                <div class="timeline-date">Applied on {{ $application->created_at->format('M d, Y') }}</div>
                            </div>
                        </div>
                        @empty
                        <div class="app-timeline-item">
                            <div class="timeline-dot"></div>
                            <div class="timeline-content">
                                <div class="job-title">No applications yet</div>
                                <div class="status-text">Start applying for jobs to track your progress</div>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
                @endif

                <!-- Quick Actions -->
                <div class="quick-actions">
                    <h2 class="section-title">Quick Actions</h2>
                    <div class="actions-grid">
                        @if($companyStats)
                        <a href="{{ route('employer.jobs.create') }}" class="action-card">
                            <div class="action-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <h3>Post New Job</h3>
                            <p>Create a new job posting</p>
                        </a>

                        <a href="{{ route('employer.jobs.index') }}" class="action-card">
                            <div class="action-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <h3>Manage Jobs</h3>
                            <p>View and edit your job postings</p>
                        </a>

                        <a href="{{ route('profile.edit') }}" class="action-card">
                            <div class="action-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H5V5zm2 4H5v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <h3>Company Profile</h3>
                            <p>Update your company information</p>
                        </a>

                        <a href="{{ route('dashboard') }}" class="action-card">
                            <div class="action-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                                </svg>
                            </div>
                            <h3>Dashboard</h3>
                            <p>View your dashboard overview</p>
                        </a>
                        @else
                        <a href="{{ route('jobs.index') }}" class="action-card">
                            <div class="action-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" clip-rule="evenodd" />
                                </svg>
                            </div>
<h3>Browse Jobs</h3>
                            <p>Find available job opportunities</p>
                        </a>

                        <a href="{{ route('user.applications') }}" class="action-card">
                            <div class="action-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <h3>My Applications</h3>
                            <p>Track your application status</p>
                        </a>

                        <a href="{{ route('profile.edit') }}" class="action-card">
                            <div class="action-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <h3>Edit Profile</h3>
                            <p>Update your profile information</p>
                        </a>

                        <a href="{{ route('dashboard') }}" class="action-card">
                            <div class="action-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                                </svg>
                            </div>
                            <h3>Dashboard</h3>
                            <p>View your dashboard overview</p>
                        </a>
                        @endif
                    </div>
                </div>

                <!-- Recent Company Applications or My Applications Table -->
                <div class="recent-section">
                    @if($companyStats)
                    <h2 class="section-title">Recent Applications</h2>
                    <div class="recent-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Applicant</th>
                                    <th>Job</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($companyApplications as $application)
                                <tr>
                                    <td>
                                        <div class="user-cell">
                                            <div class="avatar avatar-sm">{{ strtoupper(substr($application->user->name, 0, 1)) }}</div>
                                            <span>{{ $application->user->name }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $application->job->title }}</td>
                                    <td>
                                        <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $application->status)) }}">
                                            {{ $application->status }}
                                        </span>
                                    </td>
                                    <td>{{ $application->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('employer.jobs.applications', $application->job->id) }}" class="btn btn-sm btn-secondary">View</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="empty-cell">
                                        <div class="empty-state">
                                            <p>No applications received yet.</p>
                                            <a href="{{ route('employer.jobs.create') }}" class="btn btn-primary">Post a Job</a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @else
                    <h2 class="section-title">My Recent Applications</h2>
                    <div class="recent-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Job</th>
                                    <th>Status</th>
                                    <th>Applied Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($applications->take(5) as $application)
                                <tr>
                                    <td>
                                        <strong>{{ $application->job->title }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $application->job->location }}</small>
                                    </td>
                                    <td>
                                        <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $application->status)) }}">
                                            {{ $application->status }}
                                        </span>
                                    </td>
                                    <td>{{ $application->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('jobs.show', $application->job->id) }}" class="btn btn-sm btn-secondary">View Job</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="empty-cell">
                                        <div class="empty-state">
                                            <p>You haven't applied for any jobs yet.</p>
                                            <a href="{{ route('jobs.index') }}" class="btn btn-primary">Browse Jobs</a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($applications->count() > 5)
                    <div class="view-all-link">
                        <a href="{{ route('user.applications') }}" class="btn btn-secondary">View All Applications</a>
                    </div>
                    @endif
                    @endif
                </div>
            </div>

            <!-- Sidebar -->
            <div>
                @if($companyStats)
                <!-- Company Job Performance -->
                <div class="job-performance">
                    <h3>Job Performance</h3>
                    @forelse($companyJobs->take(5) as $job)
                    <div class="performance-item">
                        <span class="job-title">{{ $job->title }}</span>
                        <div class="job-stats">
                            <div class="stat">
                                <div class="stat-value">{{ $job->applications_count }}</div>
                                <div class="stat-label">Apps</div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-muted">No job data available</p>
                    @endforelse
                </div>

                <!-- Activity Timeline -->
                <div class="activity-timeline">
                    <h3>Recent Activity</h3>
                    <div class="timeline">
                        @forelse($companyApplications->take(3) as $app)
                        <div class="timeline-item">
                            <div class="timeline-dot {{ $app->status == 'Hired' ? 'success' : ($app->status == 'Rejected' ? 'danger' : 'warning') }}"></div>
                            <div class="timeline-content">
                                <div class="timeline-title">New Application</div>
                                <div class="timeline-desc">{{ $app->user->name }} applied</div>
                                <div class="timeline-time">{{ $app->created_at->diffForHumans() }}</div>
                            </div>
                        </div>
                        @empty
                        <div class="timeline-item">
                            <div class="timeline-dot"></div>
                            <div class="timeline-content">
                                <div class="timeline-title">No recent activity</div>
                                <div class="timeline-desc">Post a job to get started</div>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
                @else
                <!-- Profile Completion -->
                <div class="profile-completion">
                    <h3>Profile Completion</h3>
                    <div class="completion-circle">
                        <svg width="120" height="120" viewBox="0 0 120 120">
                            <circle cx="60" cy="60" r="54" fill="none" stroke="#dcdde1" stroke-width="8"/>
                            <circle cx="60" cy="60" r="54" fill="none" stroke="#3498db" stroke-width="8" 
                                stroke-dasharray="339.292" stroke-dashoffset="{{ 339.292 - (339.292 * $profileCompletion / 100) }}" stroke-linecap="round"/>
                        </svg>
                        <div class="completion-text">
                            <div class="completion-percent">{{ $profileCompletion }}%</div>
                            <div class="completion-label">Complete</div>
                        </div>
                    </div>
                    <ul class="profile-items">
                        <li class="{{ $profileCompletionItems['basic_info']['completed'] ? 'completed' : 'pending' }}">
                            <span>{{ $profileCompletionItems['basic_info']['completed'] ? '✓' : '○' }} Basic Information</span>
                        </li>
                        <li class="{{ $profileCompletionItems['profile_photo']['completed'] ? 'completed' : 'pending' }}">
                            <span>{{ $profileCompletionItems['profile_photo']['completed'] ? '✓' : '○' }} Profile Photo</span>
                        </li>
                        <li class="{{ $profileCompletionItems['contact_details']['completed'] ? 'completed' : 'pending' }}">
                            <span>{{ $profileCompletionItems['contact_details']['completed'] ? '✓' : '○' }} Contact Details</span>
                        </li>
                        <li class="{{ $profileCompletionItems['resume']['completed'] ? 'completed' : 'pending' }}">
                            <span>{{ $profileCompletionItems['resume']['completed'] ? '✓' : '○' }} Resume Upload</span>
                        </li>
                    </ul>
                    <div style="text-align: center; margin-top: 15px;">
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-sm">Complete Profile</a>
                    </div>
                </div>

                <!-- Job Recommendations -->
                <div class="job-recommendations">
                    <h3>Recommended Jobs</h3>
                    @forelse($availableJobs as $job)
                    <div class="recommendation-card">
                        <div class="company-logo">{{ strtoupper(substr($job->employer->name ?? 'C', 0, 1)) }}</div>
                        <div class="job-info">
                            <div class="job-title">{{ $job->title }}</div>
                            <div class="company-name">{{ $job->employer->name ?? 'Company' }}</div>
                            <div class="job-meta">
                                <span>{{ $job->location }}</span>
                                @if($job->salary)
                                <span>{{ $job->salary }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-muted">No jobs available at the moment</p>
                    @endforelse
                </div>
                @endif

                <!-- Tips Card -->
                <div class="card">
                    <div class="card-header">
                        <h3 style="margin: 0; font-size: 1.1rem;">{{ $companyStats ? 'Hiring Tips' : 'Application Tips' }}</h3>
                    </div>
                    <div class="card-body">
                        @if($companyStats)
                        <ul style="padding-left: 20px; margin: 0;">
                            <li style="margin-bottom: 10px; font-size: 0.9rem;">Respond to applications within 48 hours</li>
                            <li style="margin-bottom: 10px; font-size: 0.9rem;">Keep your job descriptions clear and detailed</li>
                            <li style="font-size: 0.9rem;">Use candidate shortlisting to organize applicants</li>
                        </ul>
                        @else
                        <ul style="padding-left: 20px; margin: 0;">
                            <li style="margin-bottom: 10px; font-size: 0.9rem;">Tailor your resume for each job application</li>
                            <li style="margin-bottom: 10px; font-size: 0.9rem;">Complete your profile to increase visibility</li>
                            <li style="font-size: 0.9rem;">Follow up on pending applications after 1 week</li>
                        </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

