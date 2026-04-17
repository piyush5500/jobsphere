<x-app-layout>
    <div class="dashboard-container">

        <div class="page-header">
            <a href="{{ route('admin.dashboard') }}" class="back-link" style="margin-bottom: 10px; display: inline-flex; align-items: center; gap: 6px;">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:16px;height:16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Back to Dashboard
            </a>
            <h1 style="font-family: 'Playfair Display', serif; font-size: 1.7rem; margin-bottom: 4px;">Manage Jobs</h1>
            <p style="color: #7f8c8d; font-style: italic;">View and manage all job postings on the platform</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Job Title</th>
                        <th>Employer</th>
                        <th>Location</th>
                        <th>Type</th>
                        <th>Posted</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jobs as $job)
                    <tr>
                        <td><span class="text-muted">{{ $job->id }}</span></td>
                        <td><span style="font-weight: 600; color: #2c3e50;">{{ $job->title }}</span></td>
                        <td>
                            <div class="user-cell">
                                <div class="avatar avatar-sm">{{ strtoupper(substr($job->employer->name, 0, 1)) }}</div>
                                <span>{{ $job->employer->name }}</span>
                            </div>
                        </td>
                        <td><span class="text-muted">{{ $job->location }}</span></td>
                        <td><span class="badge badge-info">{{ $job->job_type }}</span></td>
                        <td><span class="text-muted">{{ $job->created_at->format('M d, Y') }}</span></td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.jobs.show', $job->id) }}" class="btn btn-sm btn-view">View</a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="empty-cell">No job postings found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 20px;">{{ $jobs->links() }}</div>
    </div>
</x-app-layout>
