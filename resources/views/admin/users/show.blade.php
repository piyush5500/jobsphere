<x-app-layout>
    <div class="dashboard-container">

        <div class="page-header" style="display:flex;justify-content:space-between;align-items:flex-start;">
            <div>
                <a href="{{ route('admin.users') }}" class="back-link" style="display:inline-flex;align-items:center;gap:6px;margin-bottom:10px;">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:16px;height:16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Back to Users
                </a>
                <h1 style="font-family:'Playfair Display',serif;font-size:1.7rem;margin-bottom:4px;">{{ $user->name }}</h1>
                <p style="color:#7f8c8d;font-style:italic;">
                    <span class="role-badge role-{{ $user->role }}">{{ ucfirst($user->role) }}</span>
                    &nbsp;·&nbsp; Registered {{ $user->created_at->format('M d, Y') }}
                </p>
            </div>
            <a href="{{ route('chat.start', $user->id) }}" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:15px;height:15px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                Message User
            </a>
        </div>

        <div class="two-column">
            {{-- Left --}}
            <div>
                {{-- Personal Info --}}
                <div class="detail-section">
                    <h3>Personal Information</h3>
                    <div class="detail-row"><span class="detail-label">User ID</span><span class="detail-value">#{{ $user->id }}</span></div>
                    <div class="detail-row"><span class="detail-label">Full Name</span><span class="detail-value">{{ $user->name }}</span></div>
                    <div class="detail-row"><span class="detail-label">Email</span><span class="detail-value">{{ $user->email }}</span></div>
                    <div class="detail-row">
                        <span class="detail-label">Role</span>
                        <span class="detail-value"><span class="role-badge role-{{ $user->role }}">{{ ucfirst($user->role) }}</span></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Status</span>
                        <span class="detail-value">
                            <span class="status-badge {{ $user->is_active ? 'status-hired' : 'status-rejected' }}">
                                {{ $user->is_active ? 'Active' : 'Paused' }}
                            </span>
                        </span>
                    </div>
                    <div class="detail-row"><span class="detail-label">Registered</span><span class="detail-value">{{ $user->created_at->format('F d, Y — g:i A') }}</span></div>
                    <div class="detail-row"><span class="detail-label">Last Updated</span><span class="detail-value">{{ $user->updated_at->format('F d, Y — g:i A') }}</span></div>
                </div>

                {{-- Resume --}}
                @if($user->role === 'user')
                <div class="detail-section">
                    <h3>Resume</h3>
                    @if($user->resume)
                    <div class="detail-row">
                        <span class="detail-label">Uploaded Resume</span>
                        <span class="detail-value">
                            <a href="{{ asset('storage/'.$user->resume) }}" target="_blank" class="btn btn-sm btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" style="width:14px;height:14px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                View Resume
                            </a>
                        </span>
                    </div>
                    @else
                    <p class="text-muted" style="padding:10px 0;">No resume uploaded yet.</p>
                    @endif
                </div>
                @endif

                {{-- Employer Jobs --}}
                @if($user->role === 'employer' && $user->jobs->count() > 0)
                <div class="detail-section">
                    <h3>Posted Jobs ({{ $user->jobs->count() }})</h3>
                    <table class="data-table">
                        <thead><tr><th>Title</th><th>Location</th><th>Type</th><th>Posted</th><th>Apps</th></tr></thead>
                        <tbody>
                            @foreach($user->jobs as $job)
                            <tr>
                                <td style="font-weight:500;">{{ $job->title }}</td>
                                <td><span class="text-muted">{{ $job->location }}</span></td>
                                <td><span class="badge badge-info">{{ $job->job_type }}</span></td>
                                <td><span class="text-muted">{{ $job->created_at->format('M d, Y') }}</span></td>
                                <td><span class="text-muted">{{ $job->applications->count() }}</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif

                {{-- Applications --}}
                @if($user->applications->count() > 0)
                <div class="detail-section">
                    <h3>Job Applications ({{ $user->applications->count() }})</h3>
                    <table class="data-table">
                        <thead><tr><th>Job Title</th><th>Employer</th><th>Status</th><th>Applied</th></tr></thead>
                        <tbody>
                            @foreach($user->applications as $app)
                            <tr>
                                <td style="font-weight:500;">{{ $app->job->title }}</td>
                                <td><span class="text-muted">{{ $app->job->employer->name }}</span></td>
                                <td><span class="status-badge status-{{ strtolower(str_replace(' ','-',$app->status)) }}">{{ $app->status }}</span></td>
                                <td><span class="text-muted">{{ $app->created_at->format('M d, Y') }}</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>

            {{-- Right: Quick Actions --}}
            <div>
                <div class="card">
                    <div class="card-header"><h3 style="margin:0;font-size:1rem;">Quick Actions</h3></div>
                    <div class="card-body" style="display:flex;flex-direction:column;gap:10px;">
                        <a href="{{ route('chat.start', $user->id) }}" class="btn btn-primary" style="justify-content:center;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width:15px;height:15px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                            Send Message
                        </a>
                        <a href="{{ route('admin.users') }}" class="btn btn-secondary" style="justify-content:center;">
                            Back to Users List
                        </a>
                    </div>
                </div>

                {{-- Stats card --}}
                <div class="card" style="margin-top:0;">
                    <div class="card-header"><h3 style="margin:0;font-size:1rem;">Activity Summary</h3></div>
                    <div class="card-body">
                        @if($user->role === 'user')
                        <div class="detail-row" style="padding:10px 0;"><span class="detail-label">Total Applications</span><span class="detail-value" style="font-weight:700;font-size:1.1rem;">{{ $user->applications->count() }}</span></div>
                        <div class="detail-row" style="padding:10px 0;"><span class="detail-label">Approved</span><span class="detail-value" style="color:#27ae60;font-weight:600;">{{ $user->applications->whereIn('status',['Approved','Hired'])->count() }}</span></div>
                        <div class="detail-row" style="padding:10px 0;border-bottom:none;"><span class="detail-label">Rejected</span><span class="detail-value" style="color:#e74c3c;font-weight:600;">{{ $user->applications->where('status','Rejected')->count() }}</span></div>
                        @elseif($user->role === 'employer')
                        <div class="detail-row" style="padding:10px 0;"><span class="detail-label">Jobs Posted</span><span class="detail-value" style="font-weight:700;font-size:1.1rem;">{{ $user->jobs->count() }}</span></div>
                        <div class="detail-row" style="padding:10px 0;border-bottom:none;"><span class="detail-label">Total Applications</span><span class="detail-value" style="font-weight:700;">{{ $user->jobs->sum(fn($j)=>$j->applications->count()) }}</span></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
