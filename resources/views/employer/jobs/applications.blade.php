<x-app-layout>
    <div class="applications-page">
        <div class="page-header">
            <div>
                <a href="{{ route('employer.jobs.index') }}" class="back-link inline-flex items-center text-gray-600 hover:text-gray-900 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Jobs
                </a>
                <h1 class="page-title">Applications for {{ $job->title }}</h1>
                <p class="page-subtitle">{{ $applications->count() }} {{ Str::plural('application', $applications->count()) }} received</p>
            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-success mb-6">
            {{ session('success') }}
        </div>
        @endif

        @if($applications->count() > 0)
        <div class="applications-grid">
            @foreach($applications as $application)
            <div class="application-card">
                <div class="application-header">
                    <div>
                        <h3 class="applicant-name">{{ $application->user->name }}</h3>
                        <p class="applicant-email">{{ $application->user->email }}</p>
                    </div>
                    <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $application->status)) }}">
                        {{ $application->status }}
                    </span>
                </div>

                <div class="application-meta">
                    <div class="meta-item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="meta-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Applied {{ $application->created_at->format('M d, Y') }}
                    </div>
                    @if($application->resume)
                    <div class="meta-item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="meta-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <a href="{{ asset('storage/' . $application->resume) }}" target="_blank" class="resume-link">View Resume</a>
                    </div>
                    @endif
                </div>

                <div class="application-footer">
                    <form method="POST" action="{{ route('employer.applications.updateStatus', $application->id) }}">
                        @csrf
                        @method('PATCH')
                        <label class="block text-sm font-medium text-gray-700 mb-2">Update Status</label>
                        <select name="status" class="status-select" onchange="this.form.submit()">
                            <option value="Applied" {{ $application->status == 'Applied' ? 'selected' : '' }}>Applied</option>
                            <option value="Under Review" {{ $application->status == 'Under Review' ? 'selected' : '' }}>Under Review</option>
                            <option value="Approved" {{ $application->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                            <option value="Rejected" {{ $application->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="empty-state card">
            <svg xmlns="http://www.w3.org/2000/svg" class="empty-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">No applications yet</h3>
            <p class="text-gray-600">This job hasn't received any applications yet.</p>
        </div>
        @endif
    </div>
</x-app-layout>
