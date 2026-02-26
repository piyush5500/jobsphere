<x-app-layout>
    <div class="user-applications-page">
        <div class="page-header">
            <div>
                <h1 class="page-title">My Applications</h1>
                <p class="page-subtitle">Track your job applications and their status</p>
            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-success mb-6">
            {{ session('success') }}
        </div>
        @endif

        @if($myApplications->count() > 0)
        <div class="applications-list">
            @foreach($myApplications as $application)
            <div class="application-item">
                <div class="application-info">
                    <div class="job-title">{{ $application->job->title }}</div>
                    <div class="job-meta">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            {{ $application->job->employer->name }}
                        </span>
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            {{ $application->job->location }}
                        </span>
                    </div>
                </div>

                <div class="application-status-section">
                    <div class="status-timeline">
                        <div class="timeline-item {{ in_array($application->status, ['Applied', 'Under Review', 'Approved']) ? 'completed' : '' }}">
                            <span class="timeline-dot"></span>
                            <span>Applied</span>
                        </div>
                        <div class="timeline-item {{ in_array($application->status, ['Under Review', 'Approved']) ? 'completed' : '' }}">
                            <span class="timeline-dot"></span>
                            <span>Under Review</span>
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
                        {{ $application->status }}
                    </span>
                </div>

                <div class="application-actions">
                    <a href="{{ route('jobs.show', $application->job->id) }}" class="btn btn-secondary btn-sm">
                        View Job
                    </a>
                </div>

                <div class="text-muted mt-3">
                    Applied on {{ $application->created_at->format('M d, Y') }}
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="empty-state card">
            <svg xmlns="http://www.w3.org/2000/svg" class="empty-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">No applications yet</h3>
            <p class="text-gray-600 mb-4">Start applying for jobs to see them here.</p>
            <a href="{{ route('jobs.index') }}" class="btn btn-primary">Browse Jobs</a>
        </div>
        @endif
    </div>
</x-app-layout>
