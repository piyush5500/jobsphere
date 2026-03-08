<x-app-layout>
    <div class="admin-applications-page">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <a href="{{ route('admin.dashboard') }}" class="back-link">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="18" height="18">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Dashboard
                </a>
                <h1 class="page-title">Manage Applications</h1>
                <p class="page-subtitle">View and track all job applications across the platform</p>
            </div>
        </div>

        <!-- Application Stats -->
        <div class="application-stats">
            <div class="app-stat-card total">
                <div class="app-stat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div class="app-stat-info">
                    <h4>{{ $applications->total() }}</h4>
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
                    <h4>{{ $applications->where('status', 'Applied')->count() }}</h4>
                    <p>Pending</p>
                </div>
            </div>
            <div class="app-stat-card reviewed">
                <div class="app-stat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </div>
                <div class="app-stat-info">
                    <h4>{{ $applications->where('status', 'Under Review')->count() }}</h4>
                    <p>Under Review</p>
                </div>
            </div>
            <div class="app-stat-card approved">
                <div class="app-stat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="app-stat-info">
                    <h4>{{ $applications->where('status', 'Approved')->count() }}</h4>
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
                    <h4>{{ $applications->where('status', 'Rejected')->count() }}</h4>
                    <p>Rejected</p>
                </div>
            </div>
        </div>

        <!-- Applications Table -->
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Applicant</th>
                        <th>Job Title</th>
                        <th>Employer</th>
                        <th>Resume</th>
                        <th>Status</th>
                        <th>Applied</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applications as $application)
                    <tr>
                        <td>
                            <span class="text-muted">#{{ $application->id }}</span>
                        </td>
                        <td>
                            <div class="user-cell">
                                <div class="avatar">{{ strtoupper(substr($application->user->name, 0, 1)) }}</div>
                                <div class="user-info">
                                    <div class="name">{{ $application->user->name }}</div>
                                    <div class="email">{{ $application->user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span style="font-weight: 500; color: var(--classic-primary);">{{ $application->job->title }}</span>
                        </td>
                        <td>
                            <div class="user-cell">
                                <div class="avatar" style="background: linear-gradient(135deg, var(--classic-success) 0%, #219a52 100%);">
                                    {{ strtoupper(substr($application->job->employer->name, 0, 1)) }}
                                </div>
                                <span>{{ $application->job->employer->name }}</span>
                            </div>
                        </td>
                        <td>
                            @if($application->user->resume)
                                <a href="{{ asset('storage/' . $application->user->resume) }}" target="_blank" class="btn btn-sm btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="14" height="14">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    View
                                </a>
                            @else
                                <span class="text-muted" style="font-style: italic;">No resume</span>
                            @endif
                        </td>
                        <td>
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
                        </td>
                        <td>
                            <span class="text-muted">{{ $application->created_at->format('M d, Y') }}</span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('chat.start', $application->user->id) }}" class="btn btn-sm btn-secondary" title="Chat with Applicant">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                </a>
                                <a href="{{ route('jobs.show', $application->job->id) }}" class="btn btn-sm btn-secondary" title="View Job">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $applications->links() }}
        </div>
    </div>
</x-app-layout>
