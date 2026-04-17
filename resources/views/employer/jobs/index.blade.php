<x-app-layout>
    <div class="employer-container employer-jobs-page">\n        <div class="job-page-header job-header-create">\n            <div>\n                <h1 class="text-3xl font-serif mb-2">My Job Postings</h1>\n                <p class="text-gray-500 italic text-lg">Manage your posted jobs and view applications</p>\n            </div>\n            <a href="{{ route('employer.jobs.create') }}" class="btn-modern btn-primary-modern">\n                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">\n                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />\n                </svg>\n                Post New Job\n            </a>\n        </div>

@if(session('success'))\n        <div class="alert-modern alert-success">\n            {{ session('success') }}\n        </div>\n        @endif

        @if($jobs->count() > 0)
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Job Title</th>
                        <th>Location</th>
                        <th>Type</th>
                        <th>Applications</th>
                        <th>Posted</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jobs as $job)
                    <tr>
                        <td>
                            <div>
                                <strong>{{ $job->title }}</strong>
                                @if($job->salary)
                                <br>
                                <span class="text-muted">{{ $job->salary }}</span>
                                @endif
                            </div>
                        </td>
                        <td>{{ $job->location }}</td>
                        <td>
                            <span class="badge badge-info">{{ $job->job_type }}</span>
                        </td>
                        <td>
                            <a href="{{ route('employer.jobs.applications', $job->id) }}" class="application-count font-medium">
                                {{ $job->applications_count }} {{ Str::plural('Application', $job->applications_count) }}
                            </a>
                        </td>
                        <td>{{ $job->created_at->format('M d, Y') }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('employer.jobs.edit', $job->id) }}" class="btn btn-sm btn-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon-sm" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('employer.jobs.destroy', $job->id) }}" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this job?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon-sm" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="card-modern empty-state">\n            <svg xmlns="http://www.w3.org/2000/svg" class="empty-icon w-16 h-16 text-gray-400 mx-auto mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">\n                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />\n            </svg>\n            <h3 class="text-2xl font-bold text-gray-900 mb-4 text-center">No jobs posted yet</h3>\n            <p class="text-gray-600 mb-8 text-lg text-center max-w-md mx-auto leading-relaxed">Start by posting your first job to attract top talent to your company.</p>\n            <div class="text-center">\n                <a href="{{ route('employer.jobs.create') }}" class="btn-modern btn-primary-modern text-lg px-10 py-4">Post Your First Job</a>\n            </div>\n        </div>
        @endif
    </div>
</x-app-layout>
