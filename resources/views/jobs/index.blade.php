<x-app-layout>
<style>
/* ── Page Layout ── */
.jobs-page { max-width: 1400px; margin: 0 auto; padding: 28px 24px; }

/* ── Hero Banner ── */
.jobs-hero {
    background: linear-gradient(135deg, #1a252f 0%, #2c3e50 55%, #2980b9 100%);
    border-radius: 12px;
    padding: 48px 40px;
    margin-bottom: 32px;
    position: relative;
    overflow: hidden;
    color: white;
}
.jobs-hero::before {
    content: '';
    position: absolute;
    top: -80px; right: -80px;
    width: 320px; height: 320px;
    background: rgba(52,152,219,0.15);
    border-radius: 50%;
}
.jobs-hero::after {
    content: '';
    position: absolute;
    bottom: -60px; left: -60px;
    width: 220px; height: 220px;
    background: rgba(255,255,255,0.04);
    border-radius: 50%;
}
.jobs-hero-content { position: relative; z-index: 1; }
.jobs-hero h1 {
    font-family: 'Playfair Display', serif;
    font-size: 2.2rem;
    font-weight: 700;
    color: white;
    margin-bottom: 8px;
}
.jobs-hero p { font-size: 1rem; opacity: 0.85; margin-bottom: 28px; }

/* ── Search Bar ── */
.search-bar {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 10px;
    padding: 16px 20px;
}
.search-field {
    flex: 1;
    min-width: 180px;
    display: flex;
    flex-direction: column;
    gap: 6px;
}
.search-field label {
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    opacity: 0.8;
    color: white;
}
.search-field input,
.search-field select {
    padding: 10px 14px;
    border: 1.5px solid rgba(255,255,255,0.25);
    border-radius: 6px;
    background: rgba(255,255,255,0.12);
    color: white;
    font-size: 0.92rem;
    font-family: inherit;
    outline: none;
    transition: border-color 0.2s, background 0.2s;
}
.search-field input::placeholder { color: rgba(255,255,255,0.55); }
.search-field select option { background: #2c3e50; color: white; }
.search-field input:focus,
.search-field select:focus {
    border-color: rgba(255,255,255,0.6);
    background: rgba(255,255,255,0.18);
}
.search-btn {
    align-self: flex-end;
    padding: 10px 28px;
    background: white;
    color: #2c3e50;
    border: none;
    border-radius: 6px;
    font-size: 0.92rem;
    font-weight: 700;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s;
    white-space: nowrap;
}
.search-btn:hover { background: #f0f4f8; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(0,0,0,0.2); }

/* ── Results Bar ── */
.results-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    padding: 14px 20px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
    border-left: 4px solid #3498db;
}
.results-count { font-size: 0.95rem; color: #2c3e50; font-weight: 600; }
.results-count span { color: #3498db; font-size: 1.1rem; }
.filter-tags { display: flex; gap: 8px; flex-wrap: wrap; align-items: center; }
.filter-tag {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 4px 12px;
    background: #e8f4fc;
    color: #2980b9;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
}
.clear-btn {
    padding: 6px 14px;
    background: #fde8e8;
    color: #c0392b;
    border: none;
    border-radius: 6px;
    font-size: 0.82rem;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    transition: background 0.2s;
}
.clear-btn:hover { background: #f5c6cb; }

/* ── Jobs Grid ── */
.jobs-grid-layout {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
    gap: 22px;
    margin-bottom: 36px;
}

/* ── Job Card ── */
.job-card-new {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.07);
    overflow: hidden;
    transition: transform 0.25s, box-shadow 0.25s;
    border: 1px solid #eef0f3;
    display: flex;
    flex-direction: column;
    position: relative;
}
.job-card-new:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 32px rgba(44,62,80,0.13);
    border-color: #3498db;
}
.job-card-new::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, #2c3e50, #3498db);
    opacity: 0;
    transition: opacity 0.25s;
}
.job-card-new:hover::before { opacity: 1; }

.job-card-top {
    padding: 22px 22px 16px;
    display: flex;
    gap: 14px;
    align-items: flex-start;
}
.company-avatar {
    width: 52px;
    height: 52px;
    border-radius: 10px;
    background: linear-gradient(135deg, #2c3e50, #3498db);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Playfair Display', serif;
    font-size: 1.3rem;
    font-weight: 700;
    flex-shrink: 0;
    box-shadow: 0 4px 10px rgba(52,152,219,0.3);
}
.job-card-title-area { flex: 1; min-width: 0; }
.job-card-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.05rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 4px;
    line-height: 1.3;
}
.job-card-company {
    font-size: 0.85rem;
    color: #7f8c8d;
    margin-bottom: 8px;
}
.job-type-pill {
    display: inline-block;
    padding: 3px 10px;
    border-radius: 20px;
    font-size: 0.72rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.4px;
}
.pill-full    { background: #e8f4fc; color: #2980b9; }
.pill-part    { background: #fef9e7; color: #d68910; }
.pill-contract{ background: #f4ecf7; color: #8e44ad; }
.pill-intern  { background: #e8f8f0; color: #27ae60; }

.job-card-meta {
    padding: 0 22px 16px;
    display: flex;
    flex-direction: column;
    gap: 7px;
}
.job-meta-row {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.87rem;
    color: #7f8c8d;
}
.job-meta-row svg { width: 15px; height: 15px; flex-shrink: 0; color: #3498db; }
.job-meta-row.salary { color: #27ae60; font-weight: 600; }
.job-meta-row.salary svg { color: #27ae60; }

.job-card-desc {
    padding: 0 22px 16px;
    font-size: 0.87rem;
    color: #95a5a6;
    line-height: 1.6;
    flex: 1;
}

.job-card-footer {
    padding: 14px 22px;
    background: #f8f9fa;
    border-top: 1px solid #eef0f3;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.job-posted-time { font-size: 0.78rem; color: #b2bec3; display: flex; align-items: center; gap: 5px; }
.job-posted-time svg { width: 13px; height: 13px; }
.btn-apply-now {
    padding: 8px 20px;
    background: linear-gradient(135deg, #2c3e50, #3498db);
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 0.85rem;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.2s;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}
.btn-apply-now:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(52,152,219,0.4);
    color: white;
    text-decoration: none;
}
.btn-apply-now svg { width: 14px; height: 14px; }

/* ── Empty State ── */
.jobs-empty {
    text-align: center;
    padding: 80px 20px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.06);
}
.jobs-empty svg { width: 72px; height: 72px; color: #dcdde1; margin: 0 auto 20px; display: block; }
.jobs-empty h3 { font-family: 'Playfair Display', serif; font-size: 1.4rem; color: #2c3e50; margin-bottom: 10px; }
.jobs-empty p { color: #7f8c8d; margin-bottom: 24px; font-style: italic; }

/* ── Pagination ── */
.jobs-pagination { display: flex; justify-content: center; }

@media (max-width: 768px) {
    .jobs-hero { padding: 32px 20px; }
    .jobs-hero h1 { font-size: 1.6rem; }
    .search-bar { flex-direction: column; }
    .jobs-grid-layout { grid-template-columns: 1fr; }
    .results-bar { flex-direction: column; gap: 10px; align-items: flex-start; }
}
</style>

<div class="jobs-page">

    {{-- Hero Search Banner --}}
    <div class="jobs-hero">
        <div class="jobs-hero-content">
            <h1>Find Your Next Opportunity</h1>
            <p>Discover {{ $jobs->total() ?? $jobs->count() }} jobs from top companies — your dream role is waiting.</p>
            <form method="GET" action="{{ route('jobs.index') }}">
                <div class="search-bar">
                    <div class="search-field">
                        <label>Job Title / Keyword</label>
                        <input type="text" name="search" placeholder="e.g. Software Engineer..." value="{{ request('search') }}">
                    </div>
                    <div class="search-field">
                        <label>Location</label>
                        <input type="text" name="location" placeholder="City, region or Remote..." value="{{ request('location') }}">
                    </div>
                    <div class="search-field" style="max-width:180px;">
                        <label>Job Type</label>
                        <select name="job_type">
                            <option value="">All Types</option>
                            @foreach(['Full-time','Part-time','Contract','Internship'] as $t)
                            <option value="{{ $t }}" {{ request('job_type')==$t ? 'selected' : '' }}>{{ $t }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="search-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width:16px;height:16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        Search Jobs
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Results Bar --}}
    <div class="results-bar">
        <div class="results-count">
            <span>{{ $jobs->count() }}</span> job{{ $jobs->count() != 1 ? 's' : '' }} found
            @if(request()->anyFilled(['search','location','job_type']))
                matching your filters
            @endif
        </div>
        <div class="filter-tags">
            @if(request('search'))
                <span class="filter-tag">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:12px;height:12px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    {{ request('search') }}
                </span>
            @endif
            @if(request('location'))
                <span class="filter-tag">📍 {{ request('location') }}</span>
            @endif
            @if(request('job_type'))
                <span class="filter-tag">💼 {{ request('job_type') }}</span>
            @endif
            @if(request()->anyFilled(['search','location','job_type']))
                <a href="{{ route('jobs.index') }}" class="clear-btn">✕ Clear All</a>
            @endif
        </div>
    </div>

    {{-- Jobs Grid --}}
    @if($jobs->count() > 0)
    <div class="jobs-grid-layout">
        @foreach($jobs as $job)
        @php
            $pillClass = match($job->job_type) {
                'Full-time'  => 'pill-full',
                'Part-time'  => 'pill-part',
                'Contract'   => 'pill-contract',
                'Internship' => 'pill-intern',
                default      => 'pill-full',
            };
            $avatarColors = [
                'linear-gradient(135deg,#2c3e50,#3498db)',
                'linear-gradient(135deg,#1a252f,#27ae60)',
                'linear-gradient(135deg,#2c3e50,#9b59b6)',
                'linear-gradient(135deg,#1a252f,#e67e22)',
                'linear-gradient(135deg,#2c3e50,#e74c3c)',
            ];
            $color = $avatarColors[$job->id % count($avatarColors)];
        @endphp
        <div class="job-card-new">
            <div class="job-card-top">
                <div class="company-avatar" style="background:{{ $color }};">
                    {{ strtoupper(substr($job->employer->name ?? 'C', 0, 1)) }}
                </div>
                <div class="job-card-title-area">
                    <div class="job-card-title">{{ $job->title }}</div>
                    <div class="job-card-company">{{ $job->employer->name ?? 'Company' }}</div>
                    <span class="job-type-pill {{ $pillClass }}">{{ $job->job_type }}</span>
                </div>
            </div>

            <div class="job-card-meta">
                <div class="job-meta-row">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    {{ $job->location }}
                </div>
                @if($job->salary)
                <div class="job-meta-row salary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ $job->salary }}
                </div>
                @endif
                @if($job->application_deadline)
                <div class="job-meta-row" style="color:{{ $job->isApplicationOpen() ? '#e67e22' : '#e74c3c' }};">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color:inherit;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    @if($job->isApplicationOpen())
                        Deadline: {{ \Carbon\Carbon::parse($job->application_deadline)->format('M d, Y') }}
                    @else
                        <strong>Applications Closed</strong>
                    @endif
                </div>
                @endif
            </div>

            <div class="job-card-desc">{{ Str::limit($job->description, 110) }}</div>

            <div class="job-card-footer">
                <div class="job-posted-time">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ $job->created_at->diffForHumans() }}
                </div>
                <a href="{{ route('jobs.show', $job->id) }}" class="btn-apply-now">
                    View Details
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
        @endforeach
    </div>

    <div class="jobs-pagination">{{ $jobs->links() }}</div>

    @else
    <div class="jobs-empty">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <h3>No Jobs Found</h3>
        <p>Try adjusting your search filters or check back later for new opportunities.</p>
        @if(request()->anyFilled(['search','location','job_type']))
        <a href="{{ route('jobs.index') }}" class="btn-apply-now" style="display:inline-flex;">Clear Filters & Browse All</a>
        @endif
    </div>
    @endif

</div>
</x-app-layout>
