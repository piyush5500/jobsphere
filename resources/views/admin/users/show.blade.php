<x-app-layout>
    <div class="admin-container">
        <div class="page-header">
            <div>
                <a href="{{ route('admin.users') }}" class="back-link">
                    ← Back to Users
                </a>
                <h1 class="page-title">User Details</h1>
                <p class="page-subtitle">View complete user information</p>
            </div>
        </div>

        <!-- User Information -->
        <div class="detail-section">
            <h3>Personal Information</h3>
            <div class="detail-row">
                <span class="detail-label">User ID:</span>
                <span class="detail-value">{{ $user->id }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Name:</span>
                <span class="detail-value">{{ $user->name }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Email:</span>
                <span class="detail-value">{{ $user->email }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Role:</span>
                <span class="detail-value">
                    <span class="role-badge role-{{ $user->role }}">
                        {{ ucfirst($user->role) }}
                    </span>
                </span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Registered:</span>
                <span class="detail-value">{{ $user->created_at->format('F d, Y - h:i A') }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Last Updated:</span>
                <span class="detail-value">{{ $user->updated_at->format('F d, Y - h:i A') }}</span>
            </div>
        </div>

        <!-- User Resume (for job seekers) -->
        @if($user->role === 'user' && $user->resume)
        <div class="detail-section">
            <h3>Resume</h3>
            <div class="detail-row">
                <span class="detail-label">Uploaded Resume:</span>
                <span class="detail-value">
                    <a href="{{ asset('storage/' . $user->resume) }}" target="_blank" class="btn btn-sm btn-primary">
                        View/Download Resume
                    </a>
                </span>
            </div>
        </div>
        @elseif($user->role === 'user' && !$user->resume)
        <div class="detail-section">
            <h3>Resume</h3>
            <p class="text-muted">No resume uploaded</p>
        </div>
        @endif

        <!-- User Jobs (if employer) -->
        @if($user->role === 'employer' && $user->jobs->count() > 0)
        <div class="detail-section">
            <h3>Posted Jobs</h3>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Location</th>
                        <th>Type</th>
                        <th>Posted</th>
                        <th>Applications</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user->jobs as $job)
                    <tr>
                        <td>{{ $job->id }}</td>
                        <td>{{ $job->title }}</td>
                        <td>{{ $job->location }}</td>
                        <td><span class="badge badge-info">{{ $job->job_type }}</span></td>
                        <td>{{ $job->created_at->format('M d, Y') }}</td>
                        <td>{{ $job->applications->count() }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

        <!-- User Applications -->
        @if($user->applications->count() > 0)
        <div class="detail-section">
            <h3>Job Applications</h3>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Job Title</th>
                        <th>Employer</th>
                        <th>Status</th>
                        <th>Applied</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user->applications as $application)
                    <tr>
                        <td>{{ $application->id }}</td>
                        <td>{{ $application->job->title }}</td>
                        <td>{{ $application->job->employer->name }}</td>
                        <td>
                            <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $application->status)) }}">
                                {{ $application->status }}
                            </span>
                        </td>
                        <td>{{ $application->created_at->format('M d, Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

<!-- Actions -->
        <div style="margin-top: 20px; display: flex; gap: 10px;">
            <a href="{{ route('chat.start', $user->id) }}" class="btn btn-primary flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                Chat with User
            </a>
            <a href="{{ route('admin.users') }}" class="btn btn-secondary">Back to Users List</a>
        </div>
    </div>
</x-app-layout>
