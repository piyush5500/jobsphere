<x-app-layout>
    <div class="dashboard-container" style="max-width:700px;">

        <div class="page-header" style="border-left:5px solid #f39c12;">
            <a href="{{ route('admin.employees.index') }}" class="back-link" style="display:inline-flex;align-items:center;gap:6px;margin-bottom:10px;">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:16px;height:16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Back to Companies
            </a>
            <h1 style="font-family:'Playfair Display',serif;font-size:1.7rem;margin-bottom:4px;">Edit Employer</h1>
            <p style="color:#7f8c8d;font-style:italic;">Updating account for <strong>{{ $employee->name }}</strong></p>
        </div>

        @if($errors->any())
        <div class="alert alert-error">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <div>@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>
        </div>
        @endif

        <div class="card">
            <div class="card-header" style="display:flex;align-items:center;gap:10px;">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:18px;height:18px;color:#f39c12;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                <h3 style="margin:0;font-size:1rem;">Account Details</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.employees.update', $employee->id) }}">
                    @csrf @method('PUT')
                    <div class="form-group">
                        <label class="form-label">Full Name <span style="color:#e74c3c;">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $employee->name) }}" required class="form-input">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email Address <span style="color:#e74c3c;">*</span></label>
                        <input type="email" name="email" value="{{ old('email', $employee->email) }}" required class="form-input">
                    </div>
                    <div class="form-row">
                        <div class="form-group" style="margin-bottom:0;">
                            <label class="form-label">New Password</label>
                            <input type="password" name="password" class="form-input" placeholder="Leave blank to keep current">
                        </div>
                        <div class="form-group" style="margin-bottom:0;">
                            <label class="form-label">Confirm New Password</label>
                            <input type="password" name="password_confirmation" class="form-input" placeholder="Repeat new password">
                        </div>
                    </div>
                    <div style="display:flex;justify-content:flex-end;gap:12px;margin-top:24px;padding-top:20px;border-top:1px solid #dcdde1;">
                        <a href="{{ route('admin.employees.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary" style="background:#f39c12;" onmouseover="this.style.background='#e67e22'" onmouseout="this.style.background='#f39c12'">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width:16px;height:16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
