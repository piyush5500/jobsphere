<x-app-layout>
    <div class="admin-container">
        <div class="page-header">
            <div>
                <a href="{{ route('admin.jobs') }}" class="back-link">
                    ← Back to Jobs
                </a>
                <h1 class="page-title">Job Details</h1>
                <p class="page-subtitle">View complete job information</p>
            </div>
        </div>

        <!-- Job Information -->
        <div class="detail-section">
            <h3>Job Information</h3>
            <div class="detail-row">
                <span class="detail-label">Job ID:</span>
                <span class="detail-value">{{ $job->id }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Job Title:</span>
                <span class="detail-value">{{ $job->title }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Company:</span>
                <span class="detail-value">{{ $job->employer->name }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Location:</span>
                <span class="detail-value">{{ $job->location }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Job Type:</span>
                <span class="detail-value">
                    <span class="badge badge-info">{{ $job->job_type }}</span>
                </span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Salary:</span>
                <span class="detail-value">{{ $job->salary ?? 'Not specified' }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Posted:</span>
                <span class="detail-value">{{ $job->created_at->format('F d, Y - h:i A') }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Last Updated:</span>
                <span class="detail-value">{{ $job->updated_at->format('F d, Y - h:i A') }}</span>
            </div>
        </div>

        <!-- Job Description -->
        <div class="detail-section">
            <h3>Job Description</h3>
            <div style="padding: 15px 0; line-height: 1.8;">
                {{ $job->description }}
            </div>
        </div>

        <!-- Job Requirements -->
        @if($job->requirements)
        <div class="detail-section">
            <h3>Requirements</h3>
            <div style="padding: 15px 0; line-height: 1.8;">
                {{ $job->requirements }}
            </div>
        </div>
        @endif

        <!-- Applications for this Job -->
        <div class="detail-section">
            <h3>Applications ({{ $job->applications->count() }})</h3>
            @if($job->applications->count() > 0)
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Applicant Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Applied</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($job->applications as $application)
                    <tr>
                        <td>{{ $application->id }}</td>
                        <td>
                            <div class="user-cell">
                                <div class="avatar avatar-sm">{{ strtoupper(substr($application->user->name, 0, 1)) }}</div>
                                <span>{{ $application->user->name }}</span>
                            </div>
                        </td>
                        <td>{{ $application->user->email }}</td>
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
            @else
            <p class="empty-cell">No applications received for this job yet.</p>
            @endif
        </div>

        <!-- Actions -->
        <div style="margin-top: 20px;">
            <a href="{{ route('admin.jobs') }}" class="btn btn-secondary">Back to Jobs List</a>
            <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-primary" style="margin-left: 10px;">View Public Page</a>
        </div>
    </div>
</x-app-layout>
