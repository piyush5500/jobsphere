<x-app-layout>
    <div class="dashboard-container">

        <div class="page-header" style="display:flex;justify-content:space-between;align-items:flex-start;">
            <div>
                <a href="{{ route('admin.jobs') }}" class="back-link" style="display:inline-flex;align-items:center;gap:6px;margin-bottom:10px;">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:16px;height:16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Back to Jobs
                </a>
                <h1 style="font-family:'Playfair Display',serif;font-size:1.7rem;margin-bottom:4px;">{{ $job->title }}</h1>
                <p style="color:#7f8c8d;font-style:italic;">
                    Posted by <strong>{{ $job->employer->name }}</strong>
                    &nbsp;·&nbsp; {{ $job->location }}
                    &nbsp;·&nbsp; <span class="badge badge-info">{{ $job->job_type }}</span>
                </p>
            </div>
            <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-secondary btn-sm" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:14px;height:14px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                View Public Page
            </a>
        </div>

        <div class="two-column">
            {{-- Left --}}
            <div>
                {{-- Job Info --}}
                <div class="detail-section">
                    <h3>Job Information</h3>
                    <div class="detail-row"><span class="detail-label">Job ID</span><span class="detail-value">#{{ $job->id }}</span></div>
                    <div class="detail-row"><span class="detail-label">Title</span><span class="detail-value" style="font-weight:600;">{{ $job->title }}</span></div>
                    <div class="detail-row"><span class="detail-label">Employer</span><span class="detail-value">{{ $job->employer->name }}</span></div>
                    <div class="detail-row"><span class="detail-label">Location</span><span class="detail-value">{{ $job->location }}</span></div>
                    <div class="detail-row"><span class="detail-label">Job Type</span><span class="detail-value"><span class="badge badge-info">{{ $job->job_type }}</span></span></div>
                    <div class="detail-row"><span class="detail-label">Salary</span><span class="detail-value" style="color:#27ae60;font-weight:500;">{{ $job->salary ?? 'Not specified' }}</span></div>
                    <div class="detail-row"><span class="detail-label">Posted</span><span class="detail-value">{{ $job->created_at->format('F d, Y — g:i A') }}</span></div>
                    @if($job->application_deadline)
                    <div class="detail-row"><span class="detail-label">Deadline</span><span class="detail-value">{{ \Carbon\Carbon::parse($job->application_deadline)->format('F d, Y — g:i A') }}</span></div>
                    @endif
                </div>

                {{-- Description --}}
                <div class="detail-section">
                    <h3>Job Description</h3>
                    <div style="padding:15px 0;line-height:1.8;color:#2c3e50;white-space:pre-wrap;">{{ $job->description }}</div>
                </div>

                @if($job->requirements)
                <div class="detail-section">
                    <h3>Requirements</h3>
                    <div style="padding:15px 0;line-height:1.8;color:#2c3e50;white-space:pre-wrap;">{{ $job->requirements }}</div>
                </div>
                @endif

                {{-- Applications Table --}}
                <div class="detail-section">
                    <h3>Applications ({{ $job->applications->count() }})</h3>
                    @if($job->applications->count() > 0)
                    <table class="data-table">
                        <thead><tr><th>Applicant</th><th>Email</th><th>Status</th><th>Applied</th></tr></thead>
                        <tbody>
                            @foreach($job->applications as $app)
                            <tr>
                                <td>
                                    <div class="user-cell">
                                        <div class="avatar avatar-sm">{{ strtoupper(substr($app->user->name,0,1)) }}</div>
                                        <span style="font-weight:500;">{{ $app->user->name }}</span>
                                    </div>
                                </td>
                                <td><span class="text-muted">{{ $app->user->email }}</span></td>
                                <td><span class="status-badge status-{{ strtolower(str_replace(' ','-',$app->status)) }}">{{ $app->status }}</span></td>
                                <td><span class="text-muted">{{ $app->created_at->format('M d, Y') }}</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p class="text-muted" style="padding:15px 0;font-style:italic;">No applications received yet.</p>
                    @endif
                </div>
            </div>

            {{-- Right: Stats + Actions --}}
            <div>
                <div class="card" style="margin-bottom:20px;">
                    <div class="card-header"><h3 style="margin:0;font-size:1rem;">Application Stats</h3></div>
                    <div class="card-body">
                        @php
                            $apps = $job->applications;
                            $statuses = ['Applied'=>'#3498db','Under Review'=>'#f39c12','Approved'=>'#27ae60','Rejected'=>'#e74c3c'];
                        @endphp
                        @foreach($statuses as $status => $color)
                        <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 0;border-bottom:1px solid #dcdde1;">
                            <span style="font-size:0.9rem;color:#2c3e50;">{{ $status }}</span>
                            <span style="font-weight:700;font-size:1.1rem;color:{{ $color }};">{{ $apps->where('status',$status)->count() }}</span>
                        </div>
                        @endforeach
                        <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 0;">
                            <span style="font-size:0.9rem;font-weight:600;color:#2c3e50;">Total</span>
                            <span style="font-weight:700;font-size:1.2rem;color:#2c3e50;">{{ $apps->count() }}</span>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header"><h3 style="margin:0;font-size:1rem;">Actions</h3></div>
                    <div class="card-body" style="display:flex;flex-direction:column;gap:10px;">
                        <a href="{{ route('jobs.show', $job->id) }}" target="_blank" class="btn btn-primary" style="justify-content:center;">
                            View Public Listing
                        </a>
                        <a href="{{ route('admin.jobs') }}" class="btn btn-secondary" style="justify-content:center;">
                            Back to All Jobs
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
