<x-app-layout>
    <div class="admin-employees-page">
        <div class="page-header">
            <div>
                <a href="{{ route('admin.dashboard') }}" class="back-link inline-flex items-center text-gray-600 hover:text-gray-900 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Dashboard
                </a>
                <h1 class="page-title">Manage Employees</h1>
                <p class="page-subtitle">View and manage all registered employees</p>
            </div>
            <div>
                <a href="{{ route('admin.employees.create') }}" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Employee
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
                        <th>Status</th>
                        <th>Registered</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees as $employee)
                    <tr>
                        <td>{{ $employee->id }}</td>
                        <td>
                            <div class="user-cell">
                                <div class="avatar avatar-sm">{{ strtoupper(substr($employee->name, 0, 1)) }}</div>
                                <span>{{ $employee->name }}</span>
                            </div>
                        </td>
                        <td>{{ $employee->email }}</td>
                        <td>
                            <span class="status-badge status-{{ $employee->is_active ? 'active' : 'inactive' }}">
                                {{ $employee->is_active ? 'Active' : 'Paused' }}
                            </span>
                        </td>
                        <td>{{ $employee->created_at->format('M d, Y') }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.employees.show', $employee->id) }}" class="btn btn-sm btn-view">View</a>
                                <a href="{{ route('admin.employees.edit', $employee->id) }}" class="btn btn-sm btn-edit">Edit</a>
                                <form action="{{ route('admin.employees.toggleStatus', $employee->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-sm {{ $employee->is_active ? 'btn-warning' : 'btn-success' }}">
                                        {{ $employee->is_active ? 'Pause' : 'Activate' }}
                                    </button>
                                </form>
                                <form action="{{ route('admin.employees.destroy', $employee->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this employee?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-8 text-gray-500">No employees found. Click "Add Employee" to create one.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $employees->links() }}
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
    .btn-primary {
        background: #3b82f6;
        color: white;
    }
    .btn-primary:hover {
        background: #2563eb;
    }
    .btn-sm {
        padding: 0.25rem 0.75rem;
        font-size: 0.75rem;
    }
    .btn-view {
        background: #e5e7eb;
        color: #374151;
    }
    .btn-view:hover {
        background: #d1d5db;
    }
    .btn-edit {
        background: #fef3c7;
        color: #92400e;
    }
    .btn-edit:hover {
        background: #fde68a;
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
</style>
