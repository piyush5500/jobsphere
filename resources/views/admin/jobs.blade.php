<x-app-layout>
    <div class="admin-jobs-page">
        <div class="page-header">
            <div>
                <a href="{{ route('admin.dashboard') }}" class="back-link inline-flex items-center text-gray-600 hover:text-gray-900 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Dashboard
                </a>
                <h1 class="page-title">Manage Jobs</h1>
                <p class="page-subtitle">View and manage all job postings</p>
            </div>
        </div>

        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Job Title</th>
                        <th>Employer</th>
                        <th>Location</th>
                        <th>Type</th>
                        <th>Posted</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jobs as $job)
                    <tr>
                        <td>{{ $job->id }}</td>
                        <td>
                            <strong>{{ $job->title }}</strong>
                        </td>
                        <td>
                            <div class="user-cell">
                                <div class="avatar avatar-sm">{{ strtoupper(substr($job->employer->name, 0, 1)) }}</div>
                                <span>{{ $job->employer->name }}</span>
                            </div>
                        </td>
                        <td>{{ $job->location }}</td>
                        <td>
                            <span class="badge badge-info">{{ $job->job_type }}</span>
                        </td>
                        <td>{{ $job->created_at->format('M d, Y') }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.jobs.show', $job->id) }}" class="btn btn-sm btn-view">View</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $jobs->links() }}
        </div>
    </div>
</x-app-layout>
