<x-app-layout>
    <div class="dashboard-container">

        <div class="page-header" style="display:flex;justify-content:space-between;align-items:flex-start;">
            <div>
                <a href="{{ route('admin.dashboard') }}" class="back-link" style="display:inline-flex;align-items:center;gap:6px;margin-bottom:10px;">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:16px;height:16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Back to Dashboard
                </a>
                <h1 style="font-family:'Playfair Display',serif;font-size:1.7rem;margin-bottom:4px;">Manage Companies</h1>
                <p style="color:#7f8c8d;font-style:italic;">View and manage all employer accounts on the platform</p>
            </div>
            <a href="{{ route('admin.employees.create') }}" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:16px;height:16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add Employer
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>#</th>
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
                        <td><span class="text-muted">{{ $employee->id }}</span></td>
                        <td>
                            <div class="user-cell">
                                <div class="avatar avatar-sm" style="background:linear-gradient(135deg,#27ae60,#219a52);">
                                    {{ strtoupper(substr($employee->name,0,1)) }}
                                </div>
                                <span style="font-weight:500;">{{ $employee->name }}</span>
                            </div>
                        </td>
                        <td><span class="text-muted">{{ $employee->email }}</span></td>
                        <td>
                            <span class="status-badge {{ $employee->is_active ? 'status-hired' : 'status-rejected' }}">
                                {{ $employee->is_active ? 'Active' : 'Paused' }}
                            </span>
                        </td>
                        <td><span class="text-muted">{{ $employee->created_at->format('M d, Y') }}</span></td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.employees.show', $employee->id) }}" class="btn btn-sm btn-view">View</a>
                                <a href="{{ route('admin.employees.edit', $employee->id) }}" class="btn btn-sm" style="background:#fef9e7;color:#d68910;">Edit</a>
                                <form action="{{ route('admin.employees.toggleStatus', $employee->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm {{ $employee->is_active ? 'btn-secondary' : 'btn-success' }}">
                                        {{ $employee->is_active ? 'Pause' : 'Activate' }}
                                    </button>
                                </form>
                                <form action="{{ route('admin.employees.destroy', $employee->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this employer?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="empty-cell">No employers found. Click "Add Employer" to create one.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top:20px;">{{ $employees->links() }}</div>
    </div>
</x-app-layout>
