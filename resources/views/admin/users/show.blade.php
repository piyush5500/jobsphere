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
        <div style="margin-top: 20px;">
            <a href="{{ route('admin.users') }}" class="btn btn-secondary">Back to Users List</a>
        </div>
    </div>
</x-app-layout>
