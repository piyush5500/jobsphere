<x-app-layout>
    <div class="user-dashboard dashboard-container">
        <!-- Welcome Banner -->
        <div class="welcome-banner">
            <div>
                <h2>Welcome back, {{ auth()->user()->name }}!</h2>
                <p>Find your dream job and track your applications.</p>
            </div>
            <a href="{{ route('jobs.index') }}" class="banner-action">Browse Jobs</a>
        </div>

        <!-- Stats Overview -->
        <div class="quick-stats">
            <div class="quick-stat-card">
                <div class="stat-icon primary">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="stat-details">
                    <h4>{{ $totalApplications }}</h4>
                    <p>Total Applications</p>
                </div>
            </div>

            <div class="quick-stat-card">
                <div class="stat-icon warning">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="stat-details">
                    <h4>{{ $applications->where('status', 'Pending')->count() }}</h4>
                    <p>Pending</p>
                </div>
            </div>

            <div class="quick-stat-card">
                <div class="stat-icon success">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="stat-details">
                    <h4>{{ $applications->where('status', 'Hired')->count() }}</h4>
                    <p>Hired</p>
                </div>
            </div>
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
                </div>

                <!-- Application Timeline -->
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

                <!-- Quick Actions -->
                <div class="quick-actions">
                    <h2 class="section-title">Quick Actions</h2>
                    <div class="actions-grid">
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
                    </div>
                </div>

                <!-- My Applications Table -->
                <div class="recent-section">
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
                </div>
            </div>

            <!-- Sidebar -->
            <div>
                <!-- Profile Completion -->
                <div class="profile-completion">
                    <h3>Profile Completion</h3>
                    <div class="completion-circle">
                        <svg width="120" height="120" viewBox="0 0 120 120">
                            <circle cx="60" cy="60" r="54" fill="none" stroke="#dcdde1" stroke-width="8"/>
                            <circle cx="60" cy="60" r="54" fill="none" stroke="#3498db" stroke-width="8" 
                                stroke-dasharray="339.292" stroke-dashoffset="84.823" stroke-linecap="round"/>
                        </svg>
                        <div class="completion-text">
                            <div class="completion-percent">75%</div>
                            <div class="completion-label">Complete</div>
                        </div>
                    </div>
                    <ul class="profile-items">
                        <li class="completed">
                            <span>✓ Basic Information</span>
                        </li>
                        <li class="completed">
                            <span>✓ Profile Photo</span>
                        </li>
                        <li class="completed">
                            <span>✓ Contact Details</span>
                        </li>
                        <li class="pending">
                            <span>○ Resume Upload</span>
                        </li>
                    </ul>
                    <div style="text-align: center; margin-top: 15px;">
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-sm">Complete Profile</a>
                    </div>
                </div>

                <!-- Job Recommendations -->
                <div class="job-recommendations">
                    <h3>Recommended Jobs</h3>
                    <div class="recommendation-card">
                        <div class="company-logo">G</div>
                        <div class="job-info">
                            <div class="job-title">Software Engineer</div>
                            <div class="company-name">Google</div>
                            <div class="job-meta">
                                <span>Remote</span>
                                <span>$100k-150k</span>
                            </div>
                        </div>
                        <div class="match-score">95%</div>
                    </div>
                    <div class="recommendation-card">
                        <div class="company-logo">M</div>
                        <div class="job-info">
                            <div class="job-title">Full Stack Developer</div>
                            <div class="company-name">Microsoft</div>
                            <div class="job-meta">
                                <span>Hybrid</span>
                                <span>$90k-130k</span>
                            </div>
                        </div>
                        <div class="match-score">88%</div>
                    </div>
                    <div class="recommendation-card">
                        <div class="company-logo">A</div>
                        <div class="job-info">
                            <div class="job-title">Backend Developer</div>
                            <div class="company-name">Amazon</div>
                            <div class="job-meta">
                                <span>On-site</span>
                                <span>$95k-140k</span>
                            </div>
                        </div>
                        <div class="match-score">82%</div>
                    </div>
                </div>

                <!-- Application Tips -->
                <div class="card">
                    <div class="card-header">
                        <h3 style="margin: 0; font-size: 1.1rem;">Application Tips</h3>
                    </div>
                    <div class="card-body">
                        <ul style="padding-left: 20px; margin: 0;">
                            <li style="margin-bottom: 10px; font-size: 0.9rem;">Tailor your resume for each job application</li>
                            <li style="margin-bottom: 10px; font-size: 0.9rem;">Complete your profile to increase visibility</li>
                            <li style="font-size: 0.9rem;">Follow up on pending applications after 1 week</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
