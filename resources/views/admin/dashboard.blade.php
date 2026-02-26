<x-app-layout>
    <div class="admin-dashboard dashboard-container">
        <!-- Welcome Banner -->
        <div class="welcome-banner">
            <div>
                <h2>Welcome back, {{ auth()->user()->name }}!</h2>
                <p>Here's what's happening with your job portal today.</p>
            </div>
            <a href="{{ route('admin.users') }}" class="banner-action">Manage Users</a>
        </div>

        <!-- Stats Overview -->
        <div class="quick-stats">
            <div class="quick-stat-card">
                <div class="stat-icon primary">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                    </svg>
                </div>
                <div class="stat-details">
                    <h4>{{ $stats['totalUsers'] }}</h4>
                    <p>Total Users</p>
                </div>
            </div>

            <div class="quick-stat-card">
                <div class="stat-icon success">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="stat-details">
                    <h4>{{ $stats['totalJobs'] }}</h4>
                    <p>Active Jobs</p>
                </div>
            </div>

            <div class="quick-stat-card">
                <div class="stat-icon warning">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                    </svg>
                </div>
                <div class="stat-details">
                    <h4>{{ $stats['totalApplications'] }}</h4>
                    <p>Applications</p>
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
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                            </svg>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-value">{{ $stats['totalUsers'] }}</h3>
                            <p class="stat-label">Total Users</p>
                        </div>
                    </div>

                    <div class="stat-card stat-card-success">
                        <div class="stat-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-value">{{ $stats['totalJobs'] }}</h3>
                            <p class="stat-label">Total Jobs</p>
                        </div>
                    </div>

                    <div class="stat-card stat-card-info">
                        <div class="stat-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
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
                            <h3 class="stat-value">{{ $stats['totalEmployers'] }}</h3>
                            <p class="stat-label">Employers</p>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="quick-actions">
                    <h2 class="section-title">Quick Actions</h2>
                    <div class="actions-grid">
                        <a href="{{ route('admin.users') }}" class="action-card">
                            <div class="action-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                </svg>
                            </div>
                            <h3>Manage Users</h3>
                            <p>View and manage all registered users</p>
                        </a>

                        <a href="{{ route('admin.jobs') }}" class="action-card">
                            <div class="action-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <h3>Manage Jobs</h3>
                            <p>View and manage all job postings</p>
                        </a>

                        <a href="{{ route('admin.applications') }}" class="action-card">
                            <div class="action-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <h3>Manage Applications</h3>
                            <p>View and manage all applications</p>
                        </a>

                        <a href="{{ route('jobs.index') }}" class="action-card">
                            <div class="action-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <h3>View Job Listings</h3>
                            <p>Browse all posted jobs</p>
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
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="empty-cell">No recent applications</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Recent Jobs -->
                <div class="recent-section">
                    <h2 class="section-title">Recent Job Postings</h2>
                    <div class="recent-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Job Title</th>
                                    <th>Employer</th>
                                    <th>Status</th>
                                    <th>Posted</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentJobs as $job)
                                <tr>
                                    <td>{{ $job->title }}</td>
                                    <td>
                                        <div class="user-cell">
                                            <div class="avatar avatar-sm">{{ strtoupper(substr($job->employer->name, 0, 1)) }}</div>
                                            <span>{{ $job->employer->name }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge badge-info">{{ $job->status ?? 'Active' }}</span>
                                    </td>
                                    <td>{{ $job->created_at->format('M d, Y') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="empty-cell">No recent job postings</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div>
                <!-- System Status -->
                <div class="system-status">
                    <h3>System Status</h3>
                    <div class="status-item">
                        <span class="status-label">
                            <span class="status-indicator online"></span>
                            Database
                        </span>
                        <span class="status-text">Online</span>
                    </div>
                    <div class="status-item">
                        <span class="status-label">
                            <span class="status-indicator online"></span>
                            Storage
                        </span>
                        <span class="status-text">Available</span>
                    </div>
                    <div class="status-item">
                        <span class="status-label">
                            <span class="status-indicator online"></span>
                            Email Service
                        </span>
                        <span class="status-text">Active</span>
                    </div>
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
                                <div class="timeline-desc">{{ $app->user->name }} applied for {{ $app->job->title }}</div>
                                <div class="timeline-time">{{ $app->created_at->diffForHumans() }}</div>
                            </div>
                        </div>
                        @empty
                        <div class="timeline-item">
                            <div class="timeline-dot"></div>
                            <div class="timeline-content">
                                <div class="timeline-title">No recent activity</div>
                                <div class="timeline-desc">Start by posting a job</div>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- Category Breakdown -->
                <div class="category-grid" style="flex-direction: column;">
                    <h3 style="margin-bottom: 15px;">User Breakdown</h3>
                    <div class="category-card">
                        <div class="category-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                            </svg>
                        </div>
                        <div class="category-info">
                            <h4>Job Seekers</h4>
                            <p>{{ $stats['totalJobSeekers'] }} users</p>
                        </div>
                    </div>
                    <div class="category-card">
                        <div class="category-icon" style="background: rgba(39, 174, 96, 0.1);">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="color: var(--classic-success);">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="category-info">
                            <h4>Employers</h4>
                            <p>{{ $stats['totalEmployers'] }} users</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
