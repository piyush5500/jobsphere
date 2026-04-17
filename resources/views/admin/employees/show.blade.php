<x-app-layout>
    <div class="dashboard-container">

        <div class="page-header" style="display:flex;justify-content:space-between;align-items:flex-start;">
            <div>
                <a href="{{ route('admin.employees.index') }}" class="back-link" style="display:inline-flex;align-items:center;gap:6px;margin-bottom:10px;">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:16px;height:16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Back to Companies
                </a>
                <h1 style="font-family:'Playfair Display',serif;font-size:1.7rem;margin-bottom:4px;">{{ $employee->name }}</h1>
                <p style="color:#7f8c8d;font-style:italic;">Employer account details</p>
            </div>
            <a href="{{ route('admin.employees.edit', $employee->id) }}" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:15px;height:15px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                Edit
            </a>
        </div>

        <div class="two-column">
            {{-- Left: Info --}}
            <div>
                <div class="detail-section">
                    <h3>Account Information</h3>
                    <div class="detail-row">
                        <span class="detail-label">Full Name</span>
                        <span class="detail-value">{{ $employee->name }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Email</span>
                        <span class="detail-value">{{ $employee->email }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Role</span>
                        <span class="detail-value"><span class="role-badge role-employer">Employer</span></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Status</span>
                        <span class="detail-value">
                            <span class="status-badge {{ $employee->is_active ? 'status-hired' : 'status-rejected' }}">
                                {{ $employee->is_active ? 'Active' : 'Paused' }}
                            </span>
                        </span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Registered</span>
                        <span class="detail-value">{{ $employee->created_at->format('F d, Y') }}</span>
                    </div>
                </div>

                {{-- Jobs posted --}}
                @if(isset($employee->jobs) && $employee->jobs->count() > 0)
                <div class="detail-section">
                    <h3>Posted Jobs ({{ $employee->jobs->count() }})</h3>
                    <table class="data-table">
                        <thead><tr><th>Title</th><th>Location</th><th>Type</th><th>Apps</th></tr></thead>
                        <tbody>
                            @foreach($employee->jobs as $job)
                            <tr>
                                <td style="font-weight:500;">{{ $job->title }}</td>
                                <td><span class="text-muted">{{ $job->location }}</span></td>
                                <td><span class="badge badge-info">{{ $job->job_type }}</span></td>
                                <td><span class="text-muted">{{ $job->applications_count ?? $job->applications->count() }}</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>

            {{-- Right: Actions --}}
            <div>
                <div class="card">
                    <div class="card-header"><h3 style="margin:0;font-size:1rem;">Quick Actions</h3></div>
                    <div class="card-body" style="display:flex;flex-direction:column;gap:10px;">
                        <a href="{{ route('admin.employees.edit', $employee->id) }}" class="btn btn-primary" style="justify-content:center;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width:15px;height:15px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            Edit Account
                        </a>
                        <form action="{{ route('admin.employees.toggleStatus', $employee->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn {{ $employee->is_active ? 'btn-secondary' : 'btn-success' }}" style="width:100%;justify-content:center;">
                                {{ $employee->is_active ? '⏸ Pause Account' : '▶ Activate Account' }}
                            </button>
                        </form>
                        <a href="{{ route('chat.start', $employee->id) }}" class="btn btn-secondary" style="justify-content:center;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width:15px;height:15px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                            Send Message
                        </a>
                        <div style="border-top:1px solid #dcdde1;padding-top:10px;">
                            <form action="{{ route('admin.employees.destroy', $employee->id) }}" method="POST" onsubmit="return confirm('Permanently delete this employer?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="width:100%;justify-content:center;">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="width:15px;height:15px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    Delete Employer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
