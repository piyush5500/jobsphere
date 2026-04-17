<x-app-layout>
    <div class="dashboard-container" style="max-width: 860px;">

        <!-- Page Header -->
        <div class="page-header" style="margin-bottom: 28px;">
            <h1 style="font-family: 'Playfair Display', serif; font-size: 1.7rem; margin-bottom: 4px;">My Profile</h1>
            <p style="color: #7f8c8d; font-style: italic;">Manage your personal information and account settings</p>
        </div>

        @if(session('status') === 'profile-updated')
            <div class="alert alert-success" style="margin-bottom: 20px;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Profile updated successfully.
            </div>
        @endif

        <!-- Profile Info -->
        <div class="card" style="margin-bottom: 24px;">
            <div class="card-header" style="display: flex; align-items: center; gap: 12px;">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:20px;height:20px;color:#3498db;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                <h3 style="margin: 0; font-size: 1.05rem;">Profile Information</h3>
            </div>
            <div class="card-body">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <!-- Password -->
        <div class="card" style="margin-bottom: 24px;">
            <div class="card-header" style="display: flex; align-items: center; gap: 12px;">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:20px;height:20px;color:#3498db;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                <h3 style="margin: 0; font-size: 1.05rem;">Update Password</h3>
            </div>
            <div class="card-body">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <!-- Delete Account -->
        <div class="card" style="border-top: 3px solid #e74c3c;">
            <div class="card-header" style="display: flex; align-items: center; gap: 12px; background: #fde8e8;">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:20px;height:20px;color:#e74c3c;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                <h3 style="margin: 0; font-size: 1.05rem; color: #c0392b;">Delete Account</h3>
            </div>
            <div class="card-body">
                @include('profile.partials.delete-user-form')
            </div>
        </div>

    </div>
</x-app-layout>
