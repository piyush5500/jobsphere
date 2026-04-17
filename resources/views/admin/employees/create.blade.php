<x-app-layout>
    <div class="dashboard-container" style="max-width:700px;">

        <div class="page-header" style="border-left:5px solid #27ae60;">
            <a href="{{ route('admin.employees.index') }}" class="back-link" style="display:inline-flex;align-items:center;gap:6px;margin-bottom:10px;">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:16px;height:16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Back to Companies
            </a>
            <h1 style="font-family:'Playfair Display',serif;font-size:1.7rem;margin-bottom:4px;">Add New Employer</h1>
            <p style="color:#7f8c8d;font-style:italic;">Create a new employer account on the platform</p>
        </div>

        @if($errors->any())
        <div class="alert alert-error">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <div>@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>
        </div>
        @endif

        <div class="card">
            <div class="card-header" style="display:flex;align-items:center;gap:10px;">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:18px;height:18px;color:#27ae60;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                <h3 style="margin:0;font-size:1rem;">Account Details</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.employees.store') }}">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Full Name <span style="color:#e74c3c;">*</span></label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus class="form-input" placeholder="Company or person name">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email Address <span style="color:#e74c3c;">*</span></label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required class="form-input" placeholder="employer@company.com">
                    </div>
                    <div class="form-row">
                        <div class="form-group" style="margin-bottom:0;">
                            <label class="form-label">Password <span style="color:#e74c3c;">*</span></label>
                            <input id="password" type="password" name="password" required class="form-input" placeholder="Min. 8 characters">
                        </div>
                        <div class="form-group" style="margin-bottom:0;">
                            <label class="form-label">Confirm Password <span style="color:#e74c3c;">*</span></label>
                            <input id="password_confirmation" type="password" name="password_confirmation" required class="form-input" placeholder="Repeat password">
                        </div>
                    </div>
                    <div style="display:flex;justify-content:flex-end;gap:12px;margin-top:24px;padding-top:20px;border-top:1px solid #dcdde1;">
                        <a href="{{ route('admin.employees.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-success">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width:16px;height:16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Create Employer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
