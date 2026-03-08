<x-app-layout>
    <div class="admin-users-page">
        <div class="page-header">
            <div>
                <a href="{{ route('admin.dashboard') }}" class="back-link inline-flex items-center text-gray-600 hover:text-gray-900 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Dashboard
                </a>
                <h1 class="page-title">Manage Users</h1>
                <p class="page-subtitle">View and manage all registered users</p>
            </div>
        </div>

        <!-- Tabs -->
        <div class="tabs-container">
            <div class="tabs">
                <a href="{{ route('admin.users') }}" class="tab {{ request()->routeIs('admin.users') ? 'tab-active' : '' }}">
                    All Users
                </a>
                <a href="{{ route('admin.jobseekers') }}" class="tab {{ request()->routeIs('admin.jobseekers') ? 'tab-active' : '' }}">
                    Job Seekers
                </a>
                <a href="{{ route('admin.employees.index') }}" class="tab">
                    Employees
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
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
                        <td>{{ $user->id }}</td>
                        <td>
                            <div class="user-cell">
                                <div class="avatar avatar-sm">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                                <span>{{ $user->name }}</span>
                            </div>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="role-badge role-{{ $user->role }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td>
                            @if($user->role === 'user')
                            <span class="status-badge status-{{ $user->is_active ? 'active' : 'inactive' }}">
                                {{ $user->is_active ? 'Active' : 'Paused' }}
                            </span>
                            @else
                            <span class="status-badge status-{{ $user->is_active ? 'active' : 'inactive' }}">
                                {{ $user->is_active ? 'Active' : 'Paused' }}
                            </span>
                            @endif
                        </td>
                        <td>{{ $user->created_at->format('M d, Y') }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('chat.start', $user->id) }}" class="btn btn-sm btn-secondary" title="Chat with User">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                </a>
                                <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-sm btn-view">View</a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-8 text-gray-500">No users found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>

<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1.5rem;
    }
    .page-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: #1f2937;
        margin: 0;
    }
    .page-subtitle {
        color: #6b7280;
        margin: 0.25rem 0 0;
    }
    .back-link {
        text-decoration: none;
        font-size: 0.875rem;
    }
    .tabs-container {
        margin-bottom: 1.5rem;
    }
    .tabs {
        display: flex;
        gap: 0.5rem;
        border-bottom: 2px solid #e5e7eb;
    }
    .tab {
        padding: 0.75rem 1.5rem;
        text-decoration: none;
        color: #6b7280;
        font-weight: 500;
        border-bottom: 2px solid transparent;
        margin-bottom: -2px;
        transition: all 0.2s;
    }
    .tab:hover {
        color: #374151;
    }
    .tab-active {
        color: #3b82f6;
        border-bottom-color: #3b82f6;
    }
    .table-container {
        background: white;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    .data-table {
        width: 100%;
        border-collapse: collapse;
    }
    .data-table th {
        background: #f9fafb;
        padding: 1rem;
        text-align: left;
        font-weight: 600;
        color: #374151;
        border-bottom: 1px solid #e5e7eb;
    }
    .data-table td {
        padding: 1rem;
        border-bottom: 1px solid #e5e7eb;
    }
    .data-table tr:last-child td {
        border-bottom: none;
    }
    .user-cell {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    .avatar {
        width: 2rem;
        height: 2rem;
        border-radius: 50%;
        background: #3b82f6;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.875rem;
    }
    .role-badge {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    .role-admin {
        background: #fee2e2;
        color: #991b1b;
    }
    .role-employer {
        background: #dbeafe;
        color: #1e40af;
    }
    .role-user {
        background: #d1fae5;
        color: #065f46;
    }
    .status-badge {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    .status-active {
        background: #d1fae5;
        color: #065f46;
    }
    .status-inactive {
        background: #fee2e2;
        color: #991b1b;
    }
    .action-buttons {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    .btn {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        font-weight: 500;
        text-decoration: none;
        cursor: pointer;
        border: none;
    }
    .btn-sm {
        padding: 0.25rem 0.75rem;
        font-size: 0.75rem;
    }
    .btn-secondary {
        background: #e5e7eb;
        color: #374151;
    }
    .btn-secondary:hover {
        background: #d1d5db;
    }
    .btn-view {
        background: #e5e7eb;
        color: #374151;
    }
    .btn-view:hover {
        background: #d1d5db;
    }
    .btn-warning {
        background: #fef3c7;
        color: #92400e;
    }
    .btn-warning:hover {
        background: #fde68a;
    }
    .btn-success {
        background: #d1fae5;
        color: #065f46;
    }
    .btn-success:hover {
        background: #a7f3d0;
    }
    .btn-danger {
        background: #fee2e2;
        color: #991b1b;
    }
    .btn-danger:hover {
        background: #fecaca;
    }
    .alert {
        padding: 1rem;
        border-radius: 0.5rem;
        margin-bottom: 1rem;
    }
    .alert-success {
        background: #d1fae5;
        color: #065f46;
    }
    .inline {
        display: inline;
    }
    .text-center {
        text-align: center;
    }
    .py-8 {
        padding-top: 2rem;
        padding-bottom: 2rem;
    }
    .text-gray-500 {
        color: #6b7280;
    }
    .mt-6 {
        margin-top: 1.5rem;
    }
</style>
