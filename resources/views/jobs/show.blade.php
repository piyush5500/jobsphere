<x-app-layout>
<style>
.jd-wrap { max-width: 1100px; margin: 0 auto; padding: 28px 24px; }

/* Back */
.jd-back { display: inline-flex; align-items: center; gap: 7px; color: #3498db; text-decoration: none; font-size: 0.88rem; font-weight: 500; margin-bottom: 20px; transition: gap 0.2s; }
.jd-back:hover { gap: 10px; }
.jd-back svg { width: 16px; height: 16px; }

/* Hero Header */
.jd-hero {
    background: linear-gradient(135deg, #1a252f 0%, #2c3e50 55%, #2980b9 100%);
    border-radius: 12px;
    padding: 36px 40px;
    color: white;
    margin-bottom: 28px;
    position: relative;
    overflow: hidden;
}
.jd-hero::before { content: ''; position: absolute; top: -80px; right: -80px; width: 280px; height: 280px; background: rgba(52,152,219,0.12); border-radius: 50%; }
.jd-hero::after  { content: ''; position: absolute; bottom: -50px; left: -50px; width: 180px; height: 180px; background: rgba(255,255,255,0.04); border-radius: 50%; }
.jd-hero-inner { position: relative; z-index: 1; }
.jd-hero-top { display: flex; align-items: flex-start; gap: 20px; margin-bottom: 24px; }
.jd-company-logo {
    width: 64px; height: 64px; flex-shrink: 0;
    background: rgba(255,255,255,0.15);
    border: 2px solid rgba(255,255,255,0.25);
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-family: 'Playfair Display', serif;
    font-size: 1.6rem; font-weight: 700; color: white;
}
.jd-hero-title { flex: 1; }
.jd-hero-title h1 { font-family: 'Playfair Display', serif; font-size: 1.9rem; font-weight: 700; color: white; margin-bottom: 6px; line-height: 1.2; }
.jd-hero-title .company { font-size: 1rem; opacity: 0.85; margin-bottom: 10px; }
.jd-type-badge { display: inline-block; padding: 5px 14px; background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.3); border-radius: 20px; font-size: 0.8rem; font-weight: 600; color: white; }
.jd-meta-row { display: flex; flex-wrap: wrap; gap: 20px; }
.jd-meta-item { display: flex; align-items: center; gap: 7px; font-size: 0.9rem; opacity: 0.9; }
.jd-meta-item svg { width: 16px; height: 16px; flex-shrink: 0; }
.jd-meta-item.salary { color: #81ecec; font-weight: 600; opacity: 1; }
.jd-meta-item.deadline-open { color: #ffeaa7; }
.jd-meta-item.deadline-closed { color: #ff7675; }

/* Two Column */
.jd-layout { display: grid; grid-template-columns: 1fr 370px; gap: 30px; align-items: start; }

/* Main Content */
.jd-main-card { background: white; border-radius: 10px; box-shadow: 0 2px 12px rgba(0,0,0,0.07); overflow: hidden; border: 1px solid #eef0f3; }
.jd-section { padding: 28px 32px; border-bottom: 1px solid #eef0f3; }
.jd-section:last-child { border-bottom: none; }
.jd-section-title { display: flex; align-items: center; gap: 10px; font-family: 'Playfair Display', serif; font-size: 1.1rem; font-weight: 700; color: #2c3e50; margin-bottom: 18px; padding-bottom: 12px; border-bottom: 2px solid #eef0f3; }
.jd-section-title svg { width: 18px; height: 18px; color: #3498db; }
.jd-desc { font-size: 0.95rem; line-height: 1.85; color: #4a5568; white-space: pre-wrap; }

/* Sidebar */
.jd-sidebar { display: flex; flex-direction: column; gap: 18px; }
.jd-side-card { background: white; border-radius: 10px; box-shadow: 0 2px 12px rgba(0,0,0,0.07); overflow: hidden; border: 1px solid #eef0f3; }
.jd-side-head { padding: 16px 20px; background: #f8f9fa; border-bottom: 1px solid #eef0f3; font-family: 'Playfair Display', serif; font-size: 0.95rem; font-weight: 700; color: #2c3e50; }
.jd-side-body { padding: 20px; }

/* Apply Box */
.apply-cta {
    background: linear-gradient(135deg, #2c3e50, #3498db);
    border-radius: 10px;
    padding: 24px;
    text-align: center;
    color: white;
}
.apply-cta h3 { font-family: 'Playfair Display', serif; font-size: 1.1rem; margin-bottom: 8px; color: white; }
.apply-cta p { font-size: 0.85rem; opacity: 0.85; margin-bottom: 18px; }
.btn-apply-big {
    display: block; width: 100%;
    padding: 13px;
    background: white;
    color: #2c3e50;
    border: none; border-radius: 7px;
    font-size: 0.95rem; font-weight: 700;
    cursor: pointer; text-decoration: none;
    transition: all 0.2s;
    font-family: inherit;
}
.btn-apply-big:hover { background: #f0f4f8; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(0,0,0,0.15); }

/* Already Applied */
.applied-box { background: #e8f8f0; border: 1px solid #27ae60; border-radius: 10px; padding: 20px; text-align: center; }
.applied-box svg { width: 36px; height: 36px; color: #27ae60; margin: 0 auto 10px; display: block; }
.applied-box p { color: #27ae60; font-weight: 600; font-size: 0.92rem; margin: 0; }

/* Closed Box */
.closed-box { background: #fde8e8; border: 1px solid #e74c3c; border-radius: 10px; padding: 20px; text-align: center; }
.closed-box svg { width: 36px; height: 36px; color: #e74c3c; margin: 0 auto 10px; display: block; }
.closed-box p { color: #e74c3c; font-weight: 600; font-size: 0.92rem; margin: 0; }

/* Employer Notice */
.employer-box { background: #fef9e7; border: 1px solid #f39c12; border-radius: 10px; padding: 20px; text-align: center; }
.employer-box svg { width: 32px; height: 32px; color: #f39c12; margin: 0 auto 10px; display: block; }
.employer-box p { color: #d68910; font-size: 0.88rem; margin: 0; }

/* Login to Apply */
.login-box-apply { background: #f8f9fa; border: 1px solid #dcdde1; border-radius: 10px; padding: 24px; text-align: center; }
.login-box-apply svg { width: 40px; height: 40px; color: #3498db; margin: 0 auto 12px; display: block; }
.login-box-apply p { color: #7f8c8d; font-size: 0.88rem; margin-bottom: 14px; }
.btn-login-apply { display: block; padding: 11px; background: linear-gradient(135deg,#2c3e50,#3498db); color: white; border-radius: 7px; font-weight: 700; font-size: 0.9rem; text-decoration: none; transition: all 0.2s; }
.btn-login-apply:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(52,152,219,0.3); color: white; }

/* Resume Upload */
.resume-upload-area {
    border: 2px dashed #dcdde1;
    border-radius: 8px;
    padding: 20px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    background: linear-gradient(145deg, #fafbfc, #f8f9fa);
    margin-bottom: 12px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 80px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    outline: none !important;
}
.resume-upload-area:hover { 
    border-color: #3498db; 
    background: linear-gradient(145deg, #f0f7ff, #e3f2fd);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(52,152,219,0.15);
}
.resume-upload-area:focus-within {
    border-color: #3498db;
    box-shadow: 0 0 0 3px rgba(52,152,219,0.1);
}
.resume-upload-area input { display: none; }
.resume-upload-area svg { width: 36px; height: 36px; color: #95a5a6; margin-bottom: 12px; display: block; }
.resume-upload-area p { font-size: 0.9rem; color: #7f8c8d; margin: 0 0 4px 0; font-weight: 500; }
.resume-upload-area .upload-hint { font-size: 0.8rem; color: #bdc3c7; margin-top: 4px; }

/* Job Details List */
.jd-detail-list { list-style: none; padding: 0; margin: 0; }
.jd-detail-list li { display: flex; align-items: center; gap: 10px; padding: 10px 0; border-bottom: 1px solid #f0f0f0; font-size: 0.88rem; color: #4a5568; }
.jd-detail-list li:last-child { border-bottom: none; }
.jd-detail-list li svg { width: 15px; height: 15px; color: #3498db; flex-shrink: 0; }
.jd-detail-list li strong { color: #2c3e50; }

@media (max-width: 900px) {
    .jd-layout { grid-template-columns: 1fr; }
    .jd-sidebar { order: -1; }
    .jd-hero { padding: 24px 20px; }
    .jd-hero-title h1 { font-size: 1.5rem; }
    .jd-section { padding: 20px; }
}
</style>

<div class="jd-wrap">

    <a href="{{ route('jobs.index') }}" class="jd-back">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Back to All Jobs
    </a>

    {{-- Hero --}}
    <div class="jd-hero">
        <div class="jd-hero-inner">
            <div class="jd-hero-top">
                <div class="jd-company-logo">{{ strtoupper(substr($job->employer->name ?? 'C', 0, 1)) }}</div>
                <div class="jd-hero-title">
                    <h1>{{ $job->title }}</h1>
                    <div class="company">{{ $job->employer->name }}</div>
                    <span class="jd-type-badge">{{ $job->job_type }}</span>
                </div>
            </div>
            <div class="jd-meta-row">
                <div class="jd-meta-item">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    {{ $job->location }}
                </div>
                @if($job->salary)
                <div class="jd-meta-item salary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ $job->salary }}
                </div>
                @endif
                <div class="jd-meta-item">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Posted {{ $job->created_at->format('M d, Y') }}
                </div>
                @if($job->application_deadline)
                <div class="jd-meta-item {{ $job->isApplicationOpen() ? 'deadline-open' : 'deadline-closed' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    @if($job->isApplicationOpen())
                        Deadline: {{ \Carbon\Carbon::parse($job->application_deadline)->format('M d, Y') }}
                    @else
                        Applications Closed
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Two Column Layout --}}
    <div class="jd-layout">

        {{-- Main Content --}}
        <div class="jd-main-card">
            <div class="jd-section">
                <h2 class="jd-section-title">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Job Description
                </h2>
                <div class="jd-desc">{{ $job->description }}</div>
            </div>

            {{-- Apply Box moved below Job Description --}}
            @auth
                @if(auth()->user()->role === 'user')
                    @if($hasApplied)
                    <div class="applied-box">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <p>You've already applied for this job!</p>
                    </div>
                    @elseif($job->isApplicationOpen())
<div class="jd-side-card" style="position: sticky; top: 20px; align-self: start; width: 370px; margin: 0 auto 24px;">
                        <div class="jd-side-head">Apply for this Position</div>
<div class="jd-side-body">
                            {{-- Flash Messages --}}
                            @if (session('success'))
                            <div class="applied-box" style="margin-bottom: 16px;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width:24px;height:24px;color:#27ae60;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ session('success') }}
                            </div>
                            @endif
                            @if (session('error'))
                            <div style="background:#fde8e8;color:#c0392b;padding:10px 12px;border-radius:6px;font-size:0.85rem;margin-bottom:12px;border-left:3px solid #e74c3c;">
                                {{ session('error') }}
                            </div>
                            @endif

                            <form method="POST" action="{{ route('jobs.apply', $job->id) }}" enctype="multipart/form-data" id="applyForm">
                                @csrf
                                @if($errors->has('resume'))
                                <div style="background:#fde8e8;color:#c0392b;padding:10px 12px;border-radius:6px;font-size:0.82rem;margin-bottom:12px;border-left:3px solid #e74c3c;">
                                    {{ $errors->first('resume') }}
                                </div>
                                @endif
                                <label style="display:block;margin-bottom:{{ auth()->user()->resume ? '12px' : '6px' }};font-weight:600;font-size:0.85rem;color:#2c3e50;">
                                    Resume {{ !auth()->user()->resume ? '(Recommended)' : '' }}
                                    @if(auth()->user()->resume)
                                        <div style="background:#e8f8f0;border:1px solid #27ae60;border-radius:4px;padding:8px;font-size:0.8rem;margin-top:6px;">
                                            <strong>Current:</strong> {{ basename(auth()->user()->resume) }} 
                                            <a href="{{ \Illuminate\Support\Facades\Storage::url(auth()->user()->resume) }}" target="_blank" style="color:#27ae60;">View</a>
                                        </div>
                                    @endif
                                </label>
                                <label class="resume-upload-area" for="resume_file">
                                    <input type="file" id="resume_file" name="resume" accept=".pdf,.doc,.docx" {{ !auth()->user()->resume ? 'required' : '' }} onchange="document.getElementById('file-name').textContent = this.files[0]?.name || 'No file chosen'">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                                    <p id="file-name">Click to upload resume</p>
                                    <p class="upload-hint">PDF, DOC, or DOCX accepted</p>
                                </label>
                                <button type="submit" class="btn-apply-big" style="background:linear-gradient(135deg,#2c3e50,#3498db);color:white;" onclick="this.innerHTML='Submitting...'; document.getElementById('applyForm').submit(); return false;">
                                    <span id="btnText">Submit Application →</span>
                                </button>
                            </form>
                            <script>
                            // Simple loading state
                            document.getElementById('applyForm').addEventListener('submit', function() {
                                document.querySelector('.btn-apply-big').innerHTML = 'Submitting...';
                            });
                            </script>
                        </div>
                    </div>
                    @else
                    <div class="closed-box" style="width: 370px; margin: 0 auto 24px;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <p>Applications are closed for this job.</p>
                    </div>
                    @endif
                @elseif(auth()->user()->role === 'employer')
                <div class="employer-box" style="width: 370px; margin: 0 auto 24px;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <p>You are logged in as an employer and cannot apply for jobs.</p>
                </div>
                @endif
            @else
                @if($job->isApplicationOpen())
                <div class="login-box-apply" style="width: 370px; margin: 0 auto 24px;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                    <p>Sign in to apply for this position</p>
                    <a href="{{ route('login') }}" class="btn-login-apply">Login to Apply</a>
                    <div style="margin-top:12px;font-size:0.8rem;color:#7f8c8d;">
                        No account? <a href="{{ route('register') }}" style="color:#3498db;font-weight:600;">Register free</a>
                    </div>
                </div>
                @else
                <div class="closed-box" style="width: 370px; margin: 0 auto 24px;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <p>Applications are closed for this job.</p>
                </div>
                @endif
            @endauth

        </div>

        {{-- Sidebar - Now only Job Details --}}
        <div class="jd-sidebar">

            {{-- Job Details Card --}}
            <div class="jd-side-card">
                <div class="jd-side-head">Job Details</div>
                <div class="jd-side-body">
                    <ul class="jd-detail-list">
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <div><strong>Type</strong><br>{{ $job->job_type }}</div>
                        </li>
                        @if($job->salary)
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <div><strong>Salary</strong><br>{{ $job->salary }}</div>
                        </li>
                        @endif
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <div><strong>Location</strong><br>{{ $job->location }}</div>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <div><strong>Posted</strong><br>{{ $job->created_at->format('M d, Y') }}</div>
                        </li>
                        @if($job->application_deadline)
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <div><strong>Deadline</strong><br>{{ \Carbon\Carbon::parse($job->application_deadline)->format('M d, Y') }}</div>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>

            {{-- Browse More --}}
            <div style="text-align:center;padding:4px 0;">
                <a href="{{ route('jobs.index') }}" style="display:inline-flex;align-items:center;gap:6px;color:#3498db;text-decoration:none;font-size:0.85rem;font-weight:600;">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:14px;height:14px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Browse More Jobs
                </a>
            </div>

        </div>
    </div>
</div>
</x-app-layout>

