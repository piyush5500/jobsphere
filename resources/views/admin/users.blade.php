<x-app-layout>
    <div class="dashboard-container">

        <div class="page-header">
            <a href="{{ route('admin.dashboard') }}" class="back-link" style="margin-bottom: 10px; display: inline-flex; align-items: center; gap: 6px;">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:16px;height:16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Back to Dashboard
            </a>
            <h1 style="font-family: 'Playfair Display', serif; font-size: 1.7rem; margin-bottom: 4px;">Manage Users</h1>
            <p style="color: #7f8c8d; font-style: italic;">View and manage all registered users</p>
        </div>

        <!-- Tabs -->
        <div style="margin-bottom: 24px; border-bottom: 2px solid #dcdde1; display: flex; gap: 4px;">
            <a href="{{ route('admin.users') }}" style="padding: 10px 20px; text-decoration: none; font-size: 0.9rem; font-weight: 600; color: {{ request()->routeIs('admin.users') ? '#3498db' : '#7f8c8d' }}; border-bottom: 2px solid {{ request()->routeIs('admin.users') ? '#3498db' : 'transparent' }}; margin-bottom: -2px; transition: all 0.2s;">All Users</a>
            <a href="{{ route('admin.jobseekers') }}" style="padding: 10px 20px; text-decoration: none; font-size: 0.9rem; font-weight: 600; color: {{ request()->routeIs('admin.jobseekers') ? '#3498db' : '#7f8c8d' }}; border-bottom: 2px solid {{ request()->routeIs('admin.jobseekers') ? '#3498db' : 'transparent' }}; margin-bottom: -2px; transition: all 0.2s;">Job Seekers</a>
            <a href="{{ route('admin.employees.index') }}" style="padding: 10px 20px; text-decoration: none; font-size: 0.9rem; font-weight: 600; color: #7f8c8d; border-bottom: 2px solid transparent; margin-bottom: -2px; transition: all 0.2s;">Companies</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Registered</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td><span class="text-muted">{{ $user->id }}</span></td>
                        <td>
                            <div class="user-cell">
                                <div class="avatar avatar-sm">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                                <span style="font-weight: 500;">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td><span class="text-muted">{{ $user->email }}</span></td>
                        <td><span class="role-badge role-{{ $user->role }}">{{ ucfirst($user->role) }}</span></td>
                        <td>
                            <span class="status-badge {{ $user->is_active ? 'status-hired' : 'status-rejected' }}">
                                {{ $user->is_active ? 'Active' : 'Paused' }}
                            </span>
                        </td>
                        <td><span class="text-muted">{{ $user->created_at->format('M d, Y') }}</span></td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('chat.start', $user->id) }}" class="btn btn-sm btn-secondary" title="Chat">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="width:14px;height:14px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                </a>
                                <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-sm btn-view">View</a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="empty-cell">No users found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 20px;">{{ $users->links() }}</div>
    </div>
</x-app-layout>
