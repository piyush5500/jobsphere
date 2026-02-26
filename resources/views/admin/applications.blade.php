<x-app-layout>
    <div class="admin-applications-page">
        <div class="page-header">
            <div>
                <a href="{{ route('admin.dashboard') }}" class="back-link inline-flex items-center text-gray-600 hover:text-gray-900 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Dashboard
                </a>
                <h1 class="page-title">Manage Applications</h1>
                <p class="page-subtitle">View and track all job applications</p>
            </div>
        </div>

        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Applicant</th>
                        <th>Job Title</th>
                        <th>Employer</th>
                        <th>Status</th>
                        <th>Applied</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applications as $application)
                    <tr>
                        <td>{{ $application->id }}</td>
                        <td>
                            <div class="user-cell">
                                <div class="avatar avatar-sm">{{ strtoupper(substr($application->user->name, 0, 1)) }}</div>
                                <div>
                                    <div>{{ $application->user->name }}</div>
                                    <div class="text-muted">{{ $application->user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $application->job->title }}</td>
                        <td>
                            <div class="user-cell">
                                <div class="avatar avatar-sm">{{ strtoupper(substr($application->job->employer->name, 0, 1)) }}</div>
                                <span>{{ $application->job->employer->name }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $application->status)) }}">
                                {{ $application->status }}
                            </span>
                        </td>
                        <td>{{ $application->created_at->format('M d, Y') }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('jobs.show', $application->job->id) }}" class="btn btn-sm btn-secondary">View Job</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $applications->links() }}
        </div>
    </div>
</x-app-layout>
