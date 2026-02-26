<x-app-layout>
    <div class="jobs-container dashboard-container">
        <!-- Header Section -->
        <div class="page-header">
            <h1 class="page-title">Browse Jobs</h1>
            <p class="page-subtitle">Find your dream job from our latest opportunities</p>
        </div>

        <!-- Filters -->
        <div class="card" style="margin-bottom: 25px;">
            <div class="card-body">
                <form method="GET" action="{{ route('jobs.index') }}" class="flex flex-wrap gap-4 items-end">
                    <div class="flex-1 min-w-[200px]">
                        <label class="form-label">Search</label>
                        <input type="text" name="search" placeholder="Job title or keyword" 
                            class="form-input" 
                            value="{{ request('search') }}">
                    </div>
                    <div class="flex-1 min-w-[200px]">
                        <label class="form-label">Location</label>
                        <input type="text" name="location" placeholder="City or region" 
                            class="form-input"
                            value="{{ request('location') }}">
                    </div>
                    <div class="min-w-[150px]">
                        <label class="form-label">Job Type</label>
                        <select name="job_type" class="form-select">
                            <option value="">All Types</option>
                            <option value="Full-time" {{ request('job_type') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                            <option value="Part-time" {{ request('job_type') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                            <option value="Contract" {{ request('job_type') == 'Contract' ? 'selected' : '' }}>Contract</option>
                            <option value="Internship" {{ request('job_type') == 'Internship' ? 'selected' : '' }}>Internship</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 18px; height: 18px; margin-right: 8px;" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                        Search
                    </button>
                </form>
            </div>
        </div>

        <!-- Jobs Count -->
        <div class="flex justify-between items-center mb-4">
            <p class="text-muted">{{ $jobs->count() }} jobs found</p>
            @if(request()->anyFilled(['search', 'location', 'job_type']))
            <a href="{{ route('jobs.index') }}" class="btn btn-secondary btn-sm">Clear Filters</a>
            @endif
        </div>

        <!-- Jobs Grid -->
        @if($jobs->count() > 0)
        <div class="jobs-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 20px; margin-bottom: 30px;">
            @foreach($jobs as $job)
            <div class="job-card" style="background: var(--classic-card); border-radius: 4px; box-shadow: var(--classic-shadow); padding: 20px; transition: transform 0.3s, box-shadow 0.3s;">
                <div class="job-header" style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
                    <h3 class="job-title" style="font-size: 1.1rem; font-weight: 600; color: var(--classic-primary); margin: 0;">{{ $job->title }}</h3>
                    <span class="job-type" style="display: inline-block; padding: 4px 10px; background: var(--classic-bg); border-radius: 3px; font-size: 0.75rem; color: var(--classic-accent); white-space: nowrap;">
                        {{ $job->job_type }}
                    </span>
                </div>
                
                <div class="job-details" style="margin-bottom: 15px;">
                    <div class="detail-item" style="display: flex; align-items: center; gap: 8px; color: var(--classic-text-muted); font-size: 0.9rem; margin-bottom: 8px;">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 16px; height: 16px;" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                        </svg>
                        {{ $job->location }}
                    </div>
                    @if($job->salary)
                    <div class="detail-item" style="display: flex; align-items: center; gap: 8px; color: var(--classic-success); font-size: 0.9rem; font-weight: 500;">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 16px; height: 16px;" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0z" />
                        </svg>
                        {{ $job->salary }}
                    </div>
                    @endif
                </div>

                <p class="job-description" style="color: var(--classic-text-muted); font-size: 0.9rem; line-height: 1.5; margin-bottom: 20px;">{{ Str::limit($job->description, 120) }}</p>

                <div class="job-footer" style="display: flex; justify-content: space-between; align-items: center;">
                    <span class="text-muted" style="font-size: 0.8rem;">Posted {{ $job->created_at->diffForHumans() }}</span>
                    <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-primary btn-sm">
                        View Details
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div style="display: flex; justify-content: center; margin-top: 25px;">
            {{ $jobs->links() }}
        </div>
        @else
        <div class="empty-cell" style="background: var(--classic-card); border-radius: 4px; box-shadow: var(--classic-shadow); padding: 60px 20px; text-align: center;">
            <svg xmlns="http://www.w3.org/2000/svg" style="width: 60px; height: 60px; color: var(--classic-text-muted); margin-bottom: 20px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h3 style="font-size: 1.2rem; color: var(--classic-primary); margin-bottom: 10px;">No jobs found</h3>
            <p style="color: var(--classic-text-muted); margin-bottom: 20px;">Try adjusting your search criteria or check back later.</p>
            @if(request()->anyFilled(['search', 'location', 'job_type']))
            <a href="{{ route('jobs.index') }}" class="btn btn-primary">Clear Filters</a>
            @else
            <a href="{{ route('jobs.index') }}" class="btn btn-primary">Browse All Jobs</a>
            @endif
        </div>
        @endif
    </div>
</x-app-layout>
