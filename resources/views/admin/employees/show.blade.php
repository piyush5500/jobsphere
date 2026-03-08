<x-app-layout>
    <div class="admin-employee-show-page">
        <div class="page-header">
            <div>
                <a href="{{ route('admin.employees.index') }}" class="back-link inline-flex items-center text-gray-600 hover:text-gray-900 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Employees
                </a>
                <h1 class="page-title">Employee Details</h1>
                <p class="page-subtitle">View employee information</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('admin.employees.edit', $employee->id) }}" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit
                </a>
            </div>
        </div>

        <div class="content-grid">
            <div class="info-card">
                <h2 class="card-title">Personal Information</h2>
                <div class="info-item">
                    <span class="info-label">Name</span>
                    <span class="info-value">{{ $employee->name }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Email</span>
                    <span class="info-value">{{ $employee->email }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Role</span>
                    <span class="info-value">
                        <span class="role-badge role-employer">Employee</span>
                    </span>
                </div>
                <div class="info-item">
                    <span class="info-label">Status</span>
                    <span class="info-value">
                        <span class="status-badge status-{{ $employee->is_active ? 'active' : 'inactive' }}">
                            {{ $employee->is_active ? 'Active' : 'Paused' }}
                        </span>
                    </span>
                </div>
                <div class="info-item">
                    <span class="info-label">Registered Date</span>
                    <span class="info-value">{{ $employee->created_at->format('M d, Y') }}</span>
                </div>
            </div>

            <div class="actions-card">
                <h2 class="card-title">Quick Actions</h2>
                <div class="action-buttons">
                    <form action="{{ route('admin.employees.toggleStatus', $employee->id) }}" method="POST">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn {{ $employee->is_active ? 'btn-warning' : 'btn-success' }}">
                            {{ $employee->is_active ? 'Pause Employee' : 'Activate Employee' }}
                        </button>
                    </form>
                    <form action="{{ route('admin.employees.destroy', $employee->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this employee?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Employee</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 2rem;
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
    .header-actions {
        display: flex;
        gap: 0.5rem;
    }
    .content-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 1.5rem;
    }
    .info-card, .actions-card {
        background: white;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        padding: 1.5rem;
    }
    .card-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #1f2937;
        margin: 0 0 1.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid #e5e7eb;
    }
    .info-item {
        display: flex;
        justify-content: space-between;
        padding: 0.75rem 0;
        border-bottom: 1px solid #f3f4f6;
    }
    .info-item:last-child {
        border-bottom: none;
    }
    .info-label {
        color: #6b7280;
        font-weight: 500;
    }
    .info-value {
        color: #1f2937;
        font-weight: 500;
    }
    .role-badge {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    .role-employer {
        background: #dbeafe;
        color: #1e40af;
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
        flex-direction: column;
        gap: 0.75rem;
    }
    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.75rem 1rem;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        font-weight: 500;
        text-decoration: none;
        cursor: pointer;
        border: none;
        width: 100%;
    }
    .btn-primary {
        background: #3b82f6;
        color: white;
    }
    .btn-primary:hover {
        background: #2563eb;
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
</style>
