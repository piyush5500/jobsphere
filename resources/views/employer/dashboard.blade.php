<x-app-layout>
    <div class="employer-dashboard dashboard-container">
        <!-- Welcome Banner -->
        <div class="welcome-banner">
            <div>
                <h2>Welcome back, {{ auth()->user()->name }}!</h2>
                <p>Manage your job postings and find the best candidates.</p>
            </div>
            <a href="{{ route('employer.jobs.create') }}" class="banner-action">Post New Job</a>
        </div>

        <!-- Two Column Layout -->
        <div class="two-column">
            <!-- Main Content -->
            <div>
                <!-- Stats Cards -->
                <div class="stats-grid">
                    <div class="stat-card stat-card-primary">
                        <div class="stat-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-value">{{ $stats['totalJobs'] }}</h3>
                            <p class="stat-label">My Jobs</p>
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
                            <h3 class="stat-value">{{ $stats['totalApplications'] }}</h3>
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
                            <h3 class="stat-value">{{ $stats['pendingApplications'] }}</h3>
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
                            <h3 class="stat-value">{{ $stats['hiredApplications'] ?? 0 }}</h3>
                            <p class="stat-label">Hired</p>
                        </div>
                    </div>
                </div>

                <!-- Hiring Pipeline -->
                <div class="pipeline-section">
                    <h3>Hiring Pipeline</h3>
                    <div class="pipeline-stages">
                        <div class="pipeline-stage">
                            <div class="stage-count">{{ $stats['totalApplications'] }}</div>
                            <div class="stage-label">Total</div>
                            <div class="stage-bar"></div>
                        </div>
                        <div class="pipeline-stage">
                            <div class="stage-count">{{ $stats['pendingApplications'] }}</div>
                            <div class="stage-label">Pending</div>
                            <div class="stage-bar" style="background: var(--classic-warning);"></div>
                        </div>
                        <div class="pipeline-stage">
                            <div class="stage-count">{{ $stats['reviewedApplications'] ?? 0 }}</div>
                            <div class="stage-label">Reviewed</div>
                            <div class="stage-bar" style="background: var(--classic-accent);"></div>
                        </div>
                        <div class="pipeline-stage">
                            <div class="stage-count">{{ $stats['shortlistedApplications'] ?? 0 }}</div>
                            <div class="stage-label">Shortlisted</div>
                            <div class="stage-bar" style="background: #9b59b6;"></div>
                        </div>
                        <div class="pipeline-stage">
                            <div class="stage-count">{{ $stats['hiredApplications'] ?? 0 }}</div>
                            <div class="stage-label">Hired</div>
                            <div class="stage-bar" style="background: var(--classic-success);"></div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="quick-actions">
                    <h2 class="section-title">Quick Actions</h2>
                    <div class="actions-grid">
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
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
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
                    </div>
                </div>

                <!-- Recent Applications -->
                <div class="recent-section">
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
                                @forelse($recentApplications as $application)
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
                                    <td colspan="5" class="empty-cell">No recent applications</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div>
                <!-- Job Performance -->
                <div class="job-performance">
                    <h3>Job Performance</h3>
                    @forelse($recentApplications->take(5) as $application)
                    <div class="performance-item">
                        <span class="job-title">{{ $application->job->title }}</span>
                        <div class="job-stats">
                            <div class="stat">
                                <div class="stat-value">1</div>
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
                        @forelse($recentApplications->take(3) as $app)
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

                <!-- Tips Card -->
                <div class="card">
                    <div class="card-header">
                        <h3 style="margin: 0; font-size: 1.1rem;">Hiring Tips</h3>
                    </div>
                    <div class="card-body">
                        <ul style="padding-left: 20px; margin: 0;">
                            <li style="margin-bottom: 10px; font-size: 0.9rem;">Respond to applications within 48 hours</li>
                            <li style="margin-bottom: 10px; font-size: 0.9rem;">Keep your job descriptions clear and detailed</li>
                            <li style="font-size: 0.9rem;">Use candidate shortlisting to organize applicants</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
