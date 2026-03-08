<x-app-layout>
    <div class="job-detail-container">
        <!-- Back Link -->
        <a href="{{ route('jobs.index') }}" class="back-link">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="18" height="18">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Jobs
        </a>

        <!-- Job Detail Card -->
        <div class="job-detail-card">
            <!-- Header -->
            <div class="job-detail-header">
                <div class="header-top">
                    <div>
                        <h1 class="job-title">{{ $job->title }}</h1>
                        <p class="company-info">{{ $job->employer->name }}</p>
                    </div>
                    <span class="job-type-badge">
                        {{ $job->job_type }}
                    </span>
                </div>
                
                <div class="job-meta">
                    <div class="meta-item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="meta-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        {{ $job->location }}
                    </div>
                    @if($job->salary)
                    <div class="meta-item salary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="meta-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $job->salary }}
                    </div>
                    @endif
                    <div class="meta-item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="meta-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Posted {{ $job->created_at->format('M d, Y') }}
                    </div>
                    @if($job->application_deadline)
                    <div class="meta-item" style="{{ $job->isApplicationOpen() ? '' : 'color: #fca5a5;' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="meta-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        @if($job->isApplicationOpen())
                            Apply by {{ \Carbon\Carbon::parse($job->application_deadline)->format('M d, Y g:i A') }}
                        @else
                            Application closed
                        @endif
                    </div>
                    @endif
                </div>
            </div>

            <!-- Body -->
            <div class="job-detail-body">
                <!-- Job Description Section -->
                <div class="job-section">
                    <h2 class="job-section-title">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Job Description
                    </h2>
                    <div class="job-description-content">
                        {{ $job->description }}
                    </div>
                </div>

                <!-- Application Section -->
                @auth
                    @if(auth()->user()->role === 'user')
                        @if($hasApplied)
                            <div class="already-applied-box">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p>You have already applied for this job!</p>
                            </div>
                        @elseif($job->isApplicationOpen())
                            <div class="apply-box">
                                <h3>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                    </svg>
                                    Apply for this job
                                </h3>
                                <form method="POST" action="{{ route('jobs.apply', $job->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label class="form-label">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16" height="16" style="display: inline; vertical-align: middle; margin-right: 5px;">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            Upload Resume 
                                            @if(!auth()->user()->resume)
                                                <span style="color: red;">*</span>
                                            @else
                                                <span style="color: var(--classic-text-muted); font-weight: normal;"> (Optional - you already have a resume on file)</span>
                                            @endif
                                        </label>
                                        <input 
                                            type="file" 
                                            name="resume" 
                                            class="form-input"
                                            accept=".pdf,.doc,.docx"
                                            {{ !auth()->user()->resume ? 'required' : '' }}
                                        >
                                        <p class="help-text">
                                            @if(!auth()->user()->resume)
                                                You must upload your resume to apply for this job. Accepted formats: PDF, DOC, or DOCX.
                                            @else
                                                Upload your resume in PDF, DOC, or DOCX format.
                                            @endif
                                        </p>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="20" height="20">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                        </svg>
                                        Submit Application
                                    </button>
                                </form>
                            </div>
                        @else
                            <div class="application-closed-box">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p>Applications are closed for this job.</p>
                            </div>
                        @endif
                    @elseif(auth()->user()->role === 'employer')
                        <div class="employer-notice-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="24" height="24" style="display: inline; vertical-align: middle; margin-right: 8px; color: var(--classic-warning);">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p style="display: inline;">You are logged in as an employer. You cannot apply for jobs.</p>
                        </div>
                    @endif
                @else
                    @if($job->isApplicationOpen())
                    <div class="login-to-apply-box">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="48" height="48" style="margin: 0 auto 15px; display: block; color: var(--classic-accent);">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        <p>Please login to apply for this job.</p>
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="20" height="20">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            Login to Apply
                        </a>
                    </div>
                    @else
                    <div class="application-closed-box">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p>Applications are closed for this job.</p>
                    </div>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</x-app-layout>
