<x-app-layout>
    <div class="admin-employee-create-page">
        <div class="page-header">
            <div>
                <a href="{{ route('admin.employees.index') }}" class="back-link inline-flex items-center text-gray-600 hover:text-gray-900 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Employees
                </a>
                <h1 class="page-title">Add New Employee</h1>
                <p class="page-subtitle">Create a new employee account</p>
            </div>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-container">
            <form method="POST" action="{{ route('admin.employees.store') }}">
                @csrf

                <div class="form-group">
                    <label for="name" class="form-label">Full Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus class="form-input">
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required class="form-input">
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" name="password" required class="form-input">
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required class="form-input">
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        Create Employee
                    </button>
                    <a href="{{ route('admin.employees.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<style>
    .page-header {
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
    .form-container {
        background: white;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        padding: 2rem;
        max-width: 600px;
    }
    .form-group {
        margin-bottom: 1.5rem;
    }
    .form-label {
        display: block;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
    }
    .form-input {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        font-size: 1rem;
        box-sizing: border-box;
    }
    .form-input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    .form-actions {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
    }
    .btn {
        display: inline-flex;
        align-items: center;
        padding: 0.75rem 1.5rem;
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
    .btn-secondary {
        background: #e5e7eb;
        color: #374151;
    }
    .btn-secondary:hover {
        background: #d1d5db;
    }
    .alert {
        padding: 1rem;
        border-radius: 0.5rem;
        margin-bottom: 1rem;
    }
    .alert-danger {
        background: #fee2e2;
        color: #991b1b;
    }
</style>
