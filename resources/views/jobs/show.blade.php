<x-app-layout>
    <div class="job-detail-container dashboard-container">
        <!-- Back Link -->
        <a href="{{ route('jobs.index') }}" class="back-link">
            <svg xmlns="http://www.w3.org/2000/svg" style="width: 18px; height: 18px; margin-right: 8px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Jobs
        </a>

        <!-- Job Detail Card -->
        <div class="detail-section" style="padding: 0; overflow: hidden;">
            <!-- Header -->
            <div style="background: linear-gradient(135deg, var(--classic-primary) 0%, var(--classic-secondary) 100%); padding: 30px; color: white;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 20px;">
                    <div>
                        <h1 style="font-size: 1.8rem; font-weight: bold; margin-bottom: 8px; color: white;">{{ $job->title }}</h1>
                        <p style="opacity: 0.9; font-size: 1.1rem;">{{ $job->employer->name }}</p>
                    </div>
                    <span style="background: white; color: var(--classic-primary); padding: 8px 16px; border-radius: 4px; font-weight: 600; font-size: 0.9rem;">
                        {{ $job->job_type }}
                    </span>
                </div>
                
                <div style="display: flex; flex-wrap: wrap; gap: 20px;">
                    <div style="display: flex; align-items: center; gap: 8px; opacity: 0.9;">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 18px; height: 18px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        {{ $job->location }}
                    </div>
                    @if($job->salary)
                    <div style="display: flex; align-items: center; gap: 8px; opacity: 0.9;">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 18px; height: 18px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $job->salary }}
                    </div>
                    @endif
                    <div style="display: flex; align-items: center; gap: 8px; opacity: 0.9;">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 18px; height: 18px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Posted {{ $job->created_at->format('M d, Y') }}
                    </div>
                </div>
            </div>

            <!-- Body -->
            <div style="padding: 30px;">
                <h2 style="font-size: 1.3rem; margin-bottom: 15px; padding-bottom: 10px; border-bottom: 2px solid var(--classic-border); color: var(--classic-primary);">Job Description</h2>
                <div style="color: var(--classic-text); line-height: 1.8; white-space: pre-wrap;">
                    {{ $job->description }}
                </div>

                <!-- Application Section -->
                @auth
                    @if(auth()->user()->role === 'user')
                        @if($hasApplied)
                            <div style="background: #d4edda; border: 1px solid #c3e6cb; padding: 20px; border-radius: 4px; margin-top: 30px; display: flex; align-items: center; gap: 15px;">
                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 30px; height: 30px; color: #155724;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span style="font-weight: 600; color: #155724;">You have already applied for this job!</span>
                            </div>
                        @else
                            <div style="background: var(--classic-bg); padding: 25px; border-radius: 4px; margin-top: 30px;">
                                <h3 style="font-size: 1.1rem; font-weight: 600; margin-bottom: 20px; color: var(--classic-primary);">Apply for this job</h3>
                                <form method="POST" action="{{ route('jobs.apply', $job->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label class="form-label">Upload Resume (Optional)</label>
                                        <input type="file" name="resume" style="width: 100%; padding: 12px; border: 1px solid var(--classic-border); border-radius: 3px;" accept=".pdf,.doc,.docx">
                                        <p style="font-size: 0.85rem; color: var(--classic-text-muted); margin-top: 8px;">Upload your resume in PDF, DOC, or DOCX format.</p>
                                    </div>
                                    <button type="submit" class="btn btn-primary" style="padding: 12px 30px; font-size: 1rem;">
                                        Submit Application
                                    </button>
                                </form>
                            </div>
                        @endif
                    @elseif(auth()->user()->role === 'employer')
                        <div style="background: var(--classic-bg); border-left: 4px solid var(--classic-warning); padding: 20px; border-radius: 4px; margin-top: 30px;">
                            <p style="color: var(--classic-text-muted); margin: 0;">You are logged in as an employer. You cannot apply for jobs.</p>
                        </div>
                    @endif
                @else
                    <div style="background: var(--classic-bg); padding: 25px; border-radius: 4px; margin-top: 30px;">
                        <h3 style="font-size: 1.1rem; font-weight: 600; margin-bottom: 15px; color: var(--classic-primary);">Apply for this job</h3>
                        <p style="color: var(--classic-text-muted); margin-bottom: 20px;">Please login to apply for this job.</p>
                        <a href="{{ route('login') }}" class="btn btn-primary">Login to Apply</a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</x-app-layout>
