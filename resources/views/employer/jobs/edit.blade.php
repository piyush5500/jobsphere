<x-app-layout>
<style>
.post-job-wrap { max-width: 860px; margin: 0 auto; padding: 28px 24px; }
.pj-header {
    background: linear-gradient(135deg, #1a252f 0%, #2c3e50 60%, #e67e22 100%);
    border-radius: 10px; padding: 32px 36px; margin-bottom: 28px;
    color: white; position: relative; overflow: hidden;
}
.pj-header::after { content: ''; position: absolute; top: -60px; right: -60px; width: 200px; height: 200px; background: rgba(230,126,34,0.15); border-radius: 50%; }
.pj-header-inner { position: relative; z-index: 1; }
.pj-back { display: inline-flex; align-items: center; gap: 6px; color: rgba(255,255,255,0.7); text-decoration: none; font-size: 0.85rem; margin-bottom: 14px; transition: color 0.2s; }
.pj-back:hover { color: white; }
.pj-header h1 { font-family: 'Playfair Display', serif; font-size: 1.9rem; font-weight: 700; color: white; margin-bottom: 6px; }
.pj-header p { font-size: 0.95rem; opacity: 0.8; }
.pj-card { background: white; border-radius: 10px; box-shadow: 0 2px 12px rgba(0,0,0,0.07); margin-bottom: 20px; overflow: hidden; border: 1px solid #eef0f3; }
.pj-card-head { display: flex; align-items: center; gap: 12px; padding: 18px 24px; background: #f8f9fa; border-bottom: 1px solid #eef0f3; }
.pj-card-head .icon-wrap { width: 36px; height: 36px; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.pj-card-head .icon-wrap svg { width: 18px; height: 18px; color: white; }
.pj-card-head h3 { font-family: 'Playfair Display', serif; font-size: 1rem; font-weight: 700; color: #2c3e50; margin: 0; }
.pj-card-head p { font-size: 0.8rem; color: #7f8c8d; margin: 2px 0 0; }
.pj-card-body { padding: 24px; }
.pj-field { margin-bottom: 22px; }
.pj-field:last-child { margin-bottom: 0; }
.pj-label { display: block; margin-bottom: 7px; font-weight: 600; font-size: 0.88rem; color: #2c3e50; }
.pj-label .req { color: #e74c3c; margin-left: 2px; }
.pj-label .opt { color: #7f8c8d; font-weight: 400; font-size: 0.8rem; margin-left: 4px; }
.pj-input, .pj-select, .pj-textarea { width: 100%; padding: 11px 14px; border: 1.5px solid #dcdde1; border-radius: 7px; font-size: 0.92rem; font-family: inherit; color: #2c3e50; background: #fafafa; transition: border-color 0.2s, box-shadow 0.2s, background 0.2s; box-sizing: border-box; }
.pj-input:focus, .pj-select:focus, .pj-textarea:focus { outline: none; border-color: #e67e22; background: white; box-shadow: 0 0 0 3px rgba(230,126,34,0.1); }
.pj-textarea { resize: vertical; min-height: 160px; line-height: 1.6; }
.pj-hint { font-size: 0.8rem; color: #7f8c8d; margin-top: 5px; font-style: italic; }
.pj-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
.type-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; }
.type-option { display: none; }
.type-label { display: flex; flex-direction: column; align-items: center; padding: 14px 10px; border: 2px solid #dcdde1; border-radius: 8px; cursor: pointer; transition: all 0.2s; text-align: center; background: #fafafa; }
.type-label:hover { border-color: #e67e22; background: #fef9f0; }
.type-option:checked + .type-label { border-color: #2c3e50; background: #2c3e50; color: white; }
.type-label .type-icon { font-size: 1.4rem; margin-bottom: 6px; }
.type-label .type-name { font-size: 0.8rem; font-weight: 600; }
.status-toggle { display: flex; gap: 12px; }
.status-opt { display: none; }
.status-lbl { flex: 1; padding: 12px 16px; border: 2px solid #dcdde1; border-radius: 8px; cursor: pointer; text-align: center; font-size: 0.88rem; font-weight: 600; transition: all 0.2s; background: #fafafa; }
.status-opt:checked + .status-lbl.active-lbl { border-color: #27ae60; background: #e8f8f0; color: #27ae60; }
.status-opt:checked + .status-lbl.inactive-lbl { border-color: #e74c3c; background: #fde8e8; color: #e74c3c; }
.pj-alert { display: flex; align-items: flex-start; gap: 12px; padding: 14px 18px; background: #fde8e8; border: 1px solid rgba(231,76,60,0.3); border-left: 4px solid #e74c3c; border-radius: 8px; margin-bottom: 20px; color: #c0392b; font-size: 0.9rem; }
.pj-alert svg { width: 20px; height: 20px; flex-shrink: 0; margin-top: 1px; }
.pj-actions { display: flex; justify-content: flex-end; gap: 12px; padding: 20px 0 8px; }
.pj-btn-cancel { padding: 11px 24px; background: #f5f6fa; color: #7f8c8d; border: 1.5px solid #dcdde1; border-radius: 7px; font-size: 0.92rem; font-weight: 600; text-decoration: none; cursor: pointer; transition: all 0.2s; display: inline-flex; align-items: center; gap: 7px; }
.pj-btn-cancel:hover { background: #dcdde1; color: #2c3e50; }
.pj-btn-submit { padding: 11px 28px; background: linear-gradient(135deg, #2c3e50, #e67e22); color: white; border: none; border-radius: 7px; font-size: 0.92rem; font-weight: 700; cursor: pointer; transition: all 0.2s; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 12px rgba(230,126,34,0.3); }
.pj-btn-submit:hover { transform: translateY(-1px); box-shadow: 0 6px 18px rgba(230,126,34,0.4); }
.pj-btn-submit svg { width: 16px; height: 16px; }
@media (max-width: 640px) { .pj-row { grid-template-columns: 1fr; } .type-grid { grid-template-columns: repeat(2, 1fr); } .pj-header { padding: 24px 20px; } .pj-card-body { padding: 18px; } }

.flatpickr-calendar { box-shadow: 0 4px 20px rgba(0,0,0,0.15); border-radius: 8px; border: none; }
.flatpickr-day.selected, .flatpickr-day.selected:hover { background: #e67e22; border-color: #e67e22; }
.flatpickr-day.today { border-color: #e67e22; }
.flatpickr-day.prevMonthDay, .flatpickr-day.nextMonthDay, .flatpickr-day.disabled { color: #bdc3c7 !important; cursor: not-allowed; }

</style>
@vite(['resources/js/flatpickr.js'])
<script>
document.addEventListener('DOMContentLoaded', function() {
    flatpickr("[name='application_deadline']", {
        minDate: "today",
        dateFormat: "Y-m-d",
        enableTime: false,
        allowInput: true,
        clickOpens: true
    });
});
</script>

<div class="post-job-wrap">

    <div class="pj-header">
        <div class="pj-header-inner">
            <a href="{{ route('employer.jobs.index') }}" class="pj-back">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:15px;height:15px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Back to My Jobs
            </a>
            <h1>Edit Job Posting</h1>
            <p>Updating: <strong>{{ $job->title }}</strong></p>
        </div>
    </div>

    @if($errors->any())
    <div class="pj-alert">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <div>@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>
    </div>
    @endif

    <form method="POST" action="{{ route('employer.jobs.update', $job->id) }}">
        @csrf @method('PUT')

        <div class="pj-card">
            <div class="pj-card-head">
                <div class="icon-wrap" style="background: linear-gradient(135deg,#2c3e50,#e67e22);">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <div><h3>Basic Information</h3><p>Job title and full description</p></div>
            </div>
            <div class="pj-card-body">
                <div class="pj-field">
                    <label class="pj-label">Job Title <span class="req">*</span></label>
                    <input type="text" name="title" class="pj-input" value="{{ old('title', $job->title) }}" required maxlength="100">
                </div>
                <div class="pj-field">
                    <label class="pj-label">Job Description <span class="req">*</span></label>
                    <textarea name="description" class="pj-textarea" required>{{ old('description', $job->description) }}</textarea>
                </div>
            </div>
        </div>

        <div class="pj-card">
            <div class="pj-card-head">
                <div class="icon-wrap" style="background: linear-gradient(135deg,#27ae60,#2ecc71);">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div><h3>Location & Compensation</h3><p>Where the job is and what it pays</p></div>
            </div>
            <div class="pj-card-body">
                <div class="pj-row">
                    <div class="pj-field">
                        <label class="pj-label">Location <span class="req">*</span></label>
                        <input type="text" name="location" class="pj-input" value="{{ old('location', $job->location) }}" required>
                    </div>
                    <div class="pj-field">
                        <label class="pj-label">Salary Range <span class="opt">(optional)</span></label>
                        <input type="text" name="salary" class="pj-input" value="{{ old('salary', $job->salary) }}" placeholder="e.g. $80,000 – $120,000 / year">
                    </div>
                </div>
            </div>
        </div>

        <div class="pj-card">
            <div class="pj-card-head">
                <div class="icon-wrap" style="background: linear-gradient(135deg,#8e44ad,#9b59b6);">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <div><h3>Job Type</h3><p>Select the employment type</p></div>
            </div>
            <div class="pj-card-body">
                <div class="type-grid">
                    @php $types = ['Full-time'=>'💼','Part-time'=>'⏰','Contract'=>'📋','Internship'=>'🎓']; @endphp
                    @foreach($types as $type => $icon)
                    <div>
                        <input type="radio" name="job_type" id="etype_{{ $loop->index }}" value="{{ $type }}" class="type-option" {{ old('job_type',$job->job_type)==$type ? 'checked' : '' }} required>
                        <label for="etype_{{ $loop->index }}" class="type-label">
                            <span class="type-icon">{{ $icon }}</span>
                            <span class="type-name">{{ $type }}</span>
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="pj-card">
            <div class="pj-card-head">
                <div class="icon-wrap" style="background: linear-gradient(135deg,#f39c12,#e67e22);">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div><h3>Posting Settings</h3><p>Deadline and visibility options</p></div>
            </div>
            <div class="pj-card-body">
                <div class="pj-row">
                    <div class="pj-field">
                        <label class="pj-label">Application Deadline <span class="opt">(optional)</span></label>
                        <input type="date" name="application_deadline" class="pj-input" min="{{ today() }}"
                            value="{{ old('application_deadline', $job->application_deadline ? \Carbon\Carbon::parse($job->application_deadline)->format('Y-m-d') : '') }}">
                        <p class="pj-hint">Select date only - future dates from today. Leave blank for no deadline.</p>
                    </div>
                    <div class="pj-field">
                        <label class="pj-label">Listing Status</label>
                        <div class="status-toggle">
                            <input type="radio" name="is_active" id="estatus_active" value="1" class="status-opt" {{ old('is_active', $job->is_active ? '1':'0')=='1' ? 'checked' : '' }}>
                            <label for="estatus_active" class="status-lbl active-lbl">✓ Active</label>
                            <input type="radio" name="is_active" id="estatus_inactive" value="0" class="status-opt" {{ old('is_active', $job->is_active ? '1':'0')=='0' ? 'checked' : '' }}>
                            <label for="estatus_inactive" class="status-lbl inactive-lbl">✗ Inactive</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pj-actions">
            <a href="{{ route('employer.jobs.index') }}" class="pj-btn-cancel">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:15px;height:15px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                Cancel
            </a>
            <button type="submit" class="pj-btn-submit">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Save Changes
            </button>
        </div>
    </form>
</div>
</x-app-layout>
