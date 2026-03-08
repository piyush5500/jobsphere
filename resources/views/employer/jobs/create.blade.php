<x-app-layout>
    <div class="form-container">
        <!-- Form Header -->
        <div class="form-header">
            <a href="{{ route('employer.jobs.index') }}" class="back-link">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="18" height="18">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Jobs
            </a>
            <h1 class="page-title">Post a New Job</h1>
            <p class="page-subtitle">Fill in the details below to create a new job posting</p>
        </div>

        <!-- Job Posting Form -->
        <div class="card">
            <form method="POST" action="{{ route('employer.jobs.store') }}">
                @csrf

                <!-- Basic Information Section -->
                <div class="job-section">
                    <h2 class="job-section-title">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Basic Information
                    </h2>
                    
                    <div class="form-group">
                        <label for="title">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16" height="16" style="display: inline; vertical-align: middle; margin-right: 5px; color: var(--classic-accent);">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                            </svg>
                            Job Title <span style="color: red;">*</span>
                        </label>
                        <input type="text" name="title" id="title" class="form-input @error('title') border-red-500 @enderror" 
                            placeholder="e.g. Senior Software Engineer, Marketing Manager, UX Designer" value="{{ old('title') }}" required>
                        <p class="help-text">Choose a clear, specific title that describes the role</p>
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16" height="16" style="display: inline; vertical-align: middle; margin-right: 5px; color: var(--classic-accent);">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                            </svg>
                            Job Description <span style="color: red;">*</span>
                        </label>
                        <textarea name="description" id="description" rows="8" class="form-input @error('description') border-red-500 @enderror" 
                            placeholder="Describe the job responsibilities, requirements, qualifications, and benefits..." required>{{ old('description') }}</textarea>
                        <p class="help-text">Be detailed and specific to attract the right candidates</p>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Location & Salary Section -->
                <div class="job-section">
                    <h2 class="job-section-title">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Location & Compensation
                    </h2>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="location">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16" height="16" style="display: inline; vertical-align: middle; margin-right: 5px; color: var(--classic-accent);">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Location <span style="color: red;">*</span>
                            </label>
                            <input type="text" name="location" id="location" class="form-input @error('location') border-red-500 @enderror" 
                                placeholder="e.g. New York, NY or Remote" value="{{ old('location') }}" required>
                            @error('location')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="salary">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16" height="16" style="display: inline; vertical-align: middle; margin-right: 5px; color: var(--classic-success);">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Salary Range
                            </label>
                            <input type="text" name="salary" id="salary" class="form-input @error('salary') border-red-500 @enderror" 
                                placeholder="e.g. $80,000 - $120,000 per year" value="{{ old('salary') }}">
                            <p class="help-text">Optional - Leave blank if negotiable</p>
                            @error('salary')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Job Type & Status Section -->
                <div class="job-section">
                    <h2 class="job-section-title">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        Job Type & Status
                    </h2>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="job_type">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16" height="16" style="display: inline; vertical-align: middle; margin-right: 5px; color: var(--classic-accent);">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                Job Type <span style="color: red;">*</span>
                            </label>
                            <select name="job_type" id="job_type" class="form-input @error('job_type') border-red-500 @enderror" required>
                                <option value="">Select job type</option>
                                <option value="Full-time" {{ old('job_type') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                                <option value="Part-time" {{ old('job_type') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                                <option value="Contract" {{ old('job_type') == 'Contract' ? 'selected' : '' }}>Contract</option>
                                <option value="Internship" {{ old('job_type') == 'Internship' ? 'selected' : '' }}>Internship</option>
                            </select>
                            @error('job_type')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="application_deadline">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16" height="16" style="display: inline; vertical-align: middle; margin-right: 5px; color: var(--classic-warning);">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Application Deadline
                            </label>
                            <input type="datetime-local" name="application_deadline" id="application_deadline" 
                                class="form-input @error('application_deadline') border-red-500 @enderror" 
                                value="{{ old('application_deadline') }}">
                            <p class="help-text">Optional - Leave blank if there is no deadline</p>
                            @error('application_deadline')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="is_active">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16" height="16" style="display: inline; vertical-align: middle; margin-right: 5px; color: var(--classic-success);">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Job Status
                        </label>
                        <select name="is_active" id="is_active" class="form-input">
                            <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Active - Accepting Applications</option>
                            <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive - Not Accepting Applications</option>
                        </select>
                        <p class="help-text">Set to inactive to stop accepting applications</p>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <a href="{{ route('employer.jobs.index') }}" class="btn btn-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="18" height="18">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="18" height="18">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Post Job
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
