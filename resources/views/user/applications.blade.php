<x-app-layout>
    <div class="user-applications-page">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1 class="page-title">My Applications</h1>
                <p class="page-subtitle">Track your job applications and their status</p>
            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-success">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            {{ session('success') }}
        </div>
        @endif

        @if($myApplications->count() > 0)
        <!-- Application Stats -->
        <div class="application-stats">
            <div class="app-stat-card total">
                <div class="app-stat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div class="app-stat-info">
                    <h4>{{ $myApplications->count() }}</h4>
                    <p>Total Applications</p>
                </div>
            </div>
            <div class="app-stat-card pending">
                <div class="app-stat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="app-stat-info">
                    <h4>{{ $myApplications->where('status', 'Applied')->count() + $myApplications->where('status', 'Under Review')->count() }}</h4>
                    <p>Pending</p>
                </div>
            </div>
            <div class="app-stat-card approved">
                <div class="app-stat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="app-stat-info">
                    <h4>{{ $myApplications->where('status', 'Approved')->count() + $myApplications->where('status', 'Hired')->count() }}</h4>
                    <p>Approved</p>
                </div>
            </div>
            <div class="app-stat-card rejected">
                <div class="app-stat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="app-stat-info">
                    <h4>{{ $myApplications->where('status', 'Rejected')->count() }}</h4>
                    <p>Rejected</p>
                </div>
            </div>
        </div>

        <!-- Applications List -->
        <div class="applications-list">
            @foreach($myApplications as $application)
            <div class="application-item">
                <div class="application-info">
                    <div class="avatar">{{ strtoupper(substr($application->job->title, 0, 1)) }}</div>
                    <div>
                        <h3 class="job-title">{{ $application->job->title }}</h3>
                        <div class="job-meta">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                {{ $application->job->employer->name }}
                            </span>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ $application->job->location }}
                            </span>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Applied {{ $application->created_at->format('M d, Y') }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="application-status-section">
                    <!-- Status Timeline -->
                    <div class="status-timeline">
                        <div class="timeline-item {{ in_array($application->status, ['Applied', 'Under Review', 'Approved']) ? 'completed' : '' }}">
                            <span class="timeline-dot"></span>
                            <span>Applied</span>
                        </div>
                        <div class="timeline-item {{ in_array($application->status, ['Under Review', 'Approved']) ? 'completed' : '' }}">
                            <span class="timeline-dot"></span>
                            <span>Review</span>
                        </div>
                        <div class="timeline-item {{ $application->status == 'Approved' ? 'completed' : '' }}">
                            <span class="timeline-dot"></span>
                            <span>Approved</span>
                        </div>
                        <div class="timeline-item {{ $application->status == 'Rejected' ? 'completed' : '' }}">
                            <span class="timeline-dot"></span>
                            <span>Rejected</span>
                        </div>
                    </div>

                    <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $application->status)) }}">
                        @if($application->status == 'Applied')
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        @elseif(in_array($application->status, ['Approved', 'Hired']))
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        @elseif($application->status == 'Rejected')
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        @else
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        @endif
                        {{ $application->status }}
                    </span>
                </div>

                <div class="application-actions">
                    <a href="{{ route('jobs.show', $application->job->id) }}" class="btn btn-secondary btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16" height="16">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        View Job
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="empty-state card">
            <svg xmlns="http://www.w3.org/2000/svg" class="empty-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <h3>No applications yet</h3>
            <p>Start applying for jobs to see them here.</p>
            <a href="{{ route('jobs.index') }}" class="btn btn-primary">Browse Jobs</a>
        </div>
        @endif
    </div>
</x-app-layout>
