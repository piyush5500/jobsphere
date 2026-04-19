<x-app-layout>
<style>
.post-job-wrap { max-width: 1200px; margin: 0 auto; padding: 28px 24px; }
.pj-header { background: linear-gradient(135deg, #1a252f 0%, #2c3e50 60%, #3498db 100%); border-radius: 10px; padding: 32px 36px; margin-bottom: 28px; color: white; position: relative; overflow: hidden; }
.pj-header::after { content: ''; position: absolute; top: -60px; right: -60px; width: 200px; height: 200px; background: rgba(52,152,219,0.15); border-radius: 50%; }
.pj-header h1 { font-size: 2rem; font-weight: 700; margin-bottom: 8px; }
.pj-header p { opacity: 0.9; font-size: 1.1rem; }
.pj-btn-submit { background: linear-gradient(135deg, #3498db, #2980b9); color: white; padding: 12px 25px; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; transition: all 0.3s; }
.pj-btn-submit:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(52,152,219,0.4); }
.pj-card { background: white; border-radius: 10px; box-shadow: 0 2px 12px rgba(0,0,0,0.07); margin-bottom: 20px; overflow: hidden; border: 1px solid #eef0f3; }
.pj-card-head { padding: 18px 24px; background: #f8f9fa; border-bottom: 1px solid #eef0f3; font-size: 1.1rem; font-weight: 600; }
.pj-card-body { padding: 24px; }
.jobs-table { width: 100%; border-collapse: collapse; }
.jobs-table th { padding: 15px; background: #f8f9fa; font-weight: 600; border-bottom: 2px solid #dcdde1; text-align: left; }
.jobs-table td { padding: 15px; border-bottom: 1px solid #eef0f3; }
.jobs-table tr:hover { background: #f9fcff; }
.action-buttons { display: flex; gap: 8px; }
.btn { padding: 6px 12px; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; font-size: 0.85rem; font-weight: 500; transition: all 0.2s; }
.btn-secondary { background: #95a5a6; color: white; }
.btn-secondary:hover { background: #7f8c8d; }
.btn-danger { background: #e74c3c; color: white; }
.btn-danger:hover { background: #c0392b; }
.empty-state { text-align: center; padding: 60px 20px; }
.empty-icon { width: 80px; height: 80px; color: #bdc3c7; margin-bottom: 20px; }
.empty-text { color: #7f8c8d; margin-bottom: 25px; }
</style>

<div class="post-job-wrap">
    <div class="pj-header">
        <div>
            <h1>My Job Postings</h1>
            <p>Manage your posted jobs and view applications</p>
        </div>
        <a href="{{ route('employer.jobs.create') }}" class="pj-btn-submit">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Post New Job
        </a>
    </div>

    @if (session('success'))
        <div class="pj-card">
            <div style="padding: 15px; background: #e8f8f0; color: #27ae60; border-left: 4px solid #27ae60;">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if($jobs->count() > 0)
        <div class="pj-card">
            <div class="pj-card-head">
                <h3>Active Job Postings ({{ $jobs->count() }})</h3>
            </div>
            <div class="pj-card-body">
                <table class="jobs-table">
                    <thead>
                        <tr>
                            <th>Job Title</th>
                            <th>Location</th>
                            <th>Type</th>
                            <th>Applications</th>
                            <th>Posted</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jobs as $job)
                            <tr>
                                <td>
                                    <strong>{{ $job->title }}</strong>
                                    @if($job->salary)
                                        <br><span style="font-size: 0.9rem; color: #7f8c8d;">{{ $job->salary }}</span>
                                    @endif
                                </td>
                                <td>{{ $job->location }}</td>
                                <td>
                                    <span style="background: #e8f4fc; color: #2980b9; padding: 4px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 500;">{{ $job->job_type }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('employer.jobs.applications', $job->id) }}" style="color: #3498db; font-weight: 500;">
                                        {{ $job->applications_count }} {{ Str::plural('Application', $job->applications_count) }}
                                    </a>
                                </td>
                                <td>{{ $job->created_at->format('M d, Y') }}</td>
                                <td>
                                    <span style="background: {{ $job->is_active ? '#e8f8f0' : '#fde8e8' }}; color: {{ $job->is_active ? '#27ae60' : '#c0392b' }}; padding: 4px 12px; border-radius: 20px; font-size: 0.8rem;">
                                        {{ $job->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('employer.jobs.edit', $job->id) }}" class="btn btn-secondary">
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('employer.jobs.destroy', $job->id) }}" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this job?')" style="border: none;">
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
        </div>
    @else
        <div class="pj-card empty-state">
            <svg xmlns="http://www.w3.org/2000/svg" class="empty-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
            <h3>No jobs posted yet</h3>
            <p style="color: #7f8c8d; margin: 20px 0; font-size: 1.1rem;">Post your first job to attract candidates</p>
            <a href="{{ route('employer.jobs.create') }}" class="pj-btn-submit" style="display: inline-block; margin-top: 20px;">
                Post Your First Job
            </a>
        </div>
    @endif
</div>
</x-app-layout>
