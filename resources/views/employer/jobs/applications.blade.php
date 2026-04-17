<x-app-layout>
    <div class="dashboard-container applications-page">

        {{-- Page Header --}}
        <div class="page-header" style="display:flex;justify-content:space-between;align-items:flex-start;">
            <div>
                <a href="{{ route('employer.jobs.index') }}" class="back-link" style="display:inline-flex;align-items:center;gap:6px;margin-bottom:10px;">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:16px;height:16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Back to My Jobs
                </a>
                <h1 style="font-family:'Playfair Display',serif;font-size:1.7rem;margin-bottom:4px;">{{ $job->title }}</h1>
                <p style="color:#7f8c8d;font-style:italic;">
                    {{ $job->applications->count() }} {{ Str::plural('application', $job->applications->count()) }} received
                    &nbsp;·&nbsp; {{ $job->location }} &nbsp;·&nbsp; {{ $job->job_type }}
                </p>
            </div>
            <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-secondary btn-sm" style="white-space:nowrap;">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:15px;height:15px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                View Job Post
            </a>
        </div>

        @if(session('success'))
        <div class="alert alert-success">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
        @endif

        @if($job->applications->count() > 0)

        {{-- Stats Row --}}
        <div class="application-stats">
            <div class="app-stat-card total">
                <div class="app-stat-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg></div>
                <div class="app-stat-info"><h4>{{ $job->applications->count() }}</h4><p>Total</p></div>
            </div>
            <div class="app-stat-card pending">
                <div class="app-stat-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
                <div class="app-stat-info"><h4>{{ $job->applications->where('status','Applied')->count() }}</h4><p>New</p></div>
            </div>
            <div class="app-stat-card reviewed">
                <div class="app-stat-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg></div>
                <div class="app-stat-info"><h4>{{ $job->applications->where('status','Under Review')->count() }}</h4><p>Under Review</p></div>
            </div>
            <div class="app-stat-card approved">
                <div class="app-stat-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
                <div class="app-stat-info"><h4>{{ $job->applications->where('status','Approved')->count() }}</h4><p>Approved</p></div>
            </div>
            <div class="app-stat-card rejected">
                <div class="app-stat-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
                <div class="app-stat-info"><h4>{{ $job->applications->where('status','Rejected')->count() }}</h4><p>Rejected</p></div>
            </div>
        </div>

        {{-- Applications Grid --}}
        <div class="applications-grid">
            @foreach($job->applications as $application)
            <div class="application-card">
                {{-- Card Header --}}
                <div class="application-header">
                    <div style="display:flex;align-items:center;gap:12px;">
                        <div class="avatar" style="width:44px;height:44px;font-size:1.1rem;flex-shrink:0;">
                            {{ strtoupper(substr($application->user->name,0,1)) }}
                        </div>
                        <div>
                            <h3 class="applicant-name">{{ $application->user->name }}</h3>
                            <p class="applicant-email">{{ $application->user->email }}</p>
                        </div>
                    </div>
                    <span class="status-badge status-{{ strtolower(str_replace(' ','-',$application->status)) }}">
                        {{ $application->status }}
                    </span>
                </div>

                {{-- Meta --}}
                <div class="application-meta">
                    <div class="meta-item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="meta-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Applied {{ $application->created_at->format('M d, Y') }}
                    </div>
                    <div class="meta-item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="meta-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        @if($application->user->resume)
                            <a href="{{ asset('storage/'.$application->user->resume) }}" target="_blank" class="resume-link">View Resume</a>
                        @elseif($application->resume)
                            <a href="{{ asset('storage/'.$application->resume) }}" target="_blank" class="resume-link">View Resume</a>
                        @else
                            <span class="text-muted">No resume uploaded</span>
                        @endif
                    </div>
                </div>

                {{-- Footer: status update + chat --}}
                <div class="application-footer">
                    <div class="footer-actions">
                        <form method="POST" action="{{ route('employer.applications.updateStatus', $application->id) }}" style="flex:1;">
                            @csrf @method('PATCH')
                            <select name="status" class="status-select" onchange="this.form.submit()">
                                <option value="Applied"       {{ $application->status=='Applied'       ? 'selected':'' }}>Applied</option>
                                <option value="Under Review"  {{ $application->status=='Under Review'  ? 'selected':'' }}>Under Review</option>
                                <option value="Approved"      {{ $application->status=='Approved'      ? 'selected':'' }}>Approved</option>
                                <option value="Rejected"      {{ $application->status=='Rejected'      ? 'selected':'' }}>Rejected</option>
                            </select>
                        </form>
                        <a href="{{ route('chat.start', $application->user->id) }}" class="btn btn-sm btn-secondary" title="Chat with applicant">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width:15px;height:15px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                            Chat
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @else
        <div class="empty-state card">
            <svg xmlns="http://www.w3.org/2000/svg" class="empty-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            <h3>No applications yet</h3>
            <p>This job hasn't received any applications yet. Share the listing to attract candidates.</p>
            <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-primary">View Job Post</a>
        </div>
        @endif

    </div>
</x-app-layout>
