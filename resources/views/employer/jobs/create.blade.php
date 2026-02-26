<x-app-layout>
    <div class="form-container">
        <div class="form-header">
            <a href="{{ route('employer.jobs.index') }}" class="back-link inline-flex items-center text-gray-600 hover:text-gray-900 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Jobs
            </a>
            <h1 class="page-title">Post a New Job</h1>
            <p class="page-subtitle">Fill in the details to create a new job posting</p>
        </div>

        <div class="card">
            <form method="POST" action="{{ route('employer.jobs.store') }}">
                @csrf

                <div class="form-group">
                    <label for="title">Job Title *</label>
                    <input type="text" name="title" id="title" class="form-input @error('title') border-red-500 @enderror" 
                        placeholder="e.g. Senior Software Engineer" value="{{ old('title') }}" required>
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Job Description *</label>
                    <textarea name="description" id="description" rows="6" class="form-input @error('description') border-red-500 @enderror" 
                        placeholder="Describe the job responsibilities, requirements, and benefits..." required>{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="location">Location *</label>
                        <input type="text" name="location" id="location" class="form-input @error('location') border-red-500 @enderror" 
                            placeholder="e.g. New York, NY or Remote" value="{{ old('location') }}" required>
                        @error('location')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="salary">Salary Range</label>
                        <input type="text" name="salary" id="salary" class="form-input @error('salary') border-red-500 @enderror" 
                            placeholder="e.g. $80,000 - $120,000 per year" value="{{ old('salary') }}">
                        <p class="help-text">Optional - Leave blank if negotiable</p>
                        @error('salary')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="job_type">Job Type *</label>
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

                <div class="form-actions">
                    <a href="{{ route('employer.jobs.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="btn-icon" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        Post Job
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
