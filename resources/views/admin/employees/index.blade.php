<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-purple-50 via-indigo-50 to-purple-100 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
                    <div>
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-purple-600 hover:text-purple-500 font-medium mb-2 sm:mb-0 transition-colors duration-200" style="gap: 8px;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Back to Dashboard
                        </a>
                        <h1 class="text-3xl sm:text-4xl font-bold bg-gradient-to-r from-gray-900 to-slate-800 bg-clip-text text-transparent" style="font-family: 'Playfair Display', serif;">Manage Companies</h1>
                        <p class="mt-2 text-slate-600 text-lg">View, manage and monitor all registered employer accounts</p>
                    </div>
                    <div class="bg-purple-50/80 border border-purple-200 rounded-2xl px-6 py-3 font-bold text-purple-800 shadow-lg">
                        {{ $employees->total() ?? 0 }} Total Companies
                    </div>
                </div>

                <!-- Enhanced Tabs -->
                <div class="bg-white/80 backdrop-blur-md rounded-2xl shadow-xl border border-slate-200/50 p-1 mb-8">
                    <nav class="flex space-x-1" role="tablist">
                        <a href="{{ route('admin.users') }}" class="flex-1 py-3 px-4 text-center text-sm font-semibold rounded-xl transition-all duration-300 text-slate-600 hover:text-indigo-600 hover:bg-slate-50">
                            All Users
                        </a>
                        <a href="{{ route('admin.jobseekers') }}" class="flex-1 py-3 px-4 text-center text-sm font-semibold rounded-xl transition-all duration-300 text-slate-600 hover:text-emerald-600 hover:bg-slate-50">
                            Job Seekers
                        </a>
                        <a href="{{ route('admin.employees.index') }}" class="flex-1 py-3 px-4 text-center text-sm font-semibold rounded-xl transition-all duration-300 bg-gradient-to-r from-purple-500 to-indigo-600 text-white shadow-lg shadow-purple-500/25">
                            Companies ({{ $employees->total() ?? 0 }})
                        </a>
                    </nav>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-8 bg-purple-50 border border-purple-200 rounded-2xl p-6 shadow-md">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-purple-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-purple-800 font-semibold">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <!-- Search & Stats Card -->
            <div class="bg-white/80 backdrop-blur-lg rounded-3xl shadow-2xl border border-slate-200/50 p-8 mb-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="text-center bg-gradient-to-br from-purple-500/10 to-indigo-500/10 p-6 rounded-2xl border border-purple-200/50">
                        <div class="text-3xl font-bold text-purple-600">{{ $employees->total() ?? 0 }}</div>
                        <div class="text-slate-600 font-medium mt-1">Total Companies</div>
                    </div>
                </div>
            </div>

            <!-- Companies Table Card -->
            <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl border border-slate-200/60 overflow-hidden">
                <div class="p-8">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-8 gap-4">
                        <h2 class="text-2xl font-bold text-gray-900">Companies List</h2>
                        <div class="flex items-center gap-4 lg:w-auto flex-1">
                            <div class="relative flex-1 max-w-md">
                                <input type="text" placeholder="Search companies..." class="w-full pl-12 pr-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 text-sm">
                                <svg class="absolute left-4 top-3.5 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            <a href="{{ route('admin.employees.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-500 to-indigo-600 text-white rounded-xl shadow-lg hover:shadow-xl hover:from-purple-600 hover:to-indigo-700 font-semibold text-sm transition-all duration-300 transform hover:-translate-y-0.5 whitespace-nowrap" title="Add New Company">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                                </svg>
                                Add Company
                            </a>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full table-auto">
                            <thead>
                                <tr class="bg-gradient-to-r from-purple-50 to-purple-100/50 border-b-2 border-purple-200">
                                    <th class="px-6 py-5 text-left text-xs font-bold text-purple-800 uppercase tracking-wider">#</th>
                                    <th class="px-6 py-5 text-left text-xs font-bold text-purple-800 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-5 text-left text-xs font-bold text-purple-800 uppercase tracking-wider hidden sm:table-cell">Email</th>
                                    <th class="px-6 py-5 text-left text-xs font-bold text-purple-800 uppercase tracking-wider">Jobs</th>
                                    <th class="px-6 py-5 text-left text-xs font-bold text-purple-800 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-5 text-left text-xs font-bold text-purple-800 uppercase tracking-wider hidden lg:table-cell">Registered</th>
                                    <th class="px-6 py-5 text-left text-xs font-bold text-purple-800 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200">
                                @forelse($employees as $employee)
                                <tr class="hover:bg-purple-50/50 transition-all duration-200 group border-b border-purple-100 hover:border-purple-200 hover:shadow-md">
                                    <td class="px-6 py-6 whitespace-nowrap">
                                        <span class="text-purple-600 font-mono text-sm font-medium">{{ $employee->id }}</span>
                                    </td>
                                    <td class="px-6 py-6">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-shrink-0">
                                                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-purple-400 to-purple-500 shadow-lg flex items-center justify-center">
                                                    <span class="text-xl font-bold text-white uppercase tracking-wide">{{ strtoupper(substr($employee->name, 0, 1)) }}</span>
                                                </div>
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <div class="text-lg font-semibold text-gray-900 group-hover:text-purple-700 transition-colors">{{ $employee->name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6 whitespace-nowrap hidden sm:table-cell">
                                        <span class="text-slate-600 text-sm font-medium truncate max-w-64">{{ $employee->email }}</span>
                                    </td>
                                    <td class="px-6 py-6 whitespace-nowrap">
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-lg bg-gradient-to-r from-purple-100 to-purple-200 text-purple-800 text-sm font-bold shadow-md">
                                            {{ $employee->jobs_count ?? 0 }} Jobs
                                        </span>
                                    </td>
                                    <td class="px-6 py-6 whitespace-nowrap">
                                        <span class="inline-flex items-center px-4 py-2 rounded-full text-xs font-bold {{ $employee->is_active ? 'bg-gradient-to-r from-emerald-100 to-emerald-200 text-emerald-800 shadow-md shadow-emerald-200/50' : 'bg-gradient-to-r from-orange-100 to-orange-200 text-orange-800 shadow-md shadow-orange-200/50' }}">
                                            {{ $employee->is_active ? 'Active' : 'Paused' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-6 whitespace-nowrap hidden lg:table-cell text-sm text-slate-500">
                                        {{ $employee->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-6 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('chat.start', $employee->id) }}" class="p-2 hover:bg-purple-100 rounded-xl hover:shadow-md transition-all duration-200 text-purple-600 hover:text-purple-700" title="Chat">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                                </svg>
                                            </a>
                                            <div class="flex space-x-1">
                                                <a href="{{ route('admin.employees.show', $employee->id) }}" class="px-3 py-2 bg-gradient-to-r from-purple-500 to-indigo-600 text-white rounded-xl shadow-lg hover:shadow-xl hover:from-purple-600 hover:to-indigo-700 font-semibold text-xs transition-all duration-300 transform hover:-translate-y-0.5">
                                                    View
                                                </a>
                                                <a href="{{ route('admin.employees.edit', $employee->id) }}" class="px-3 py-2 bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 rounded-xl shadow-md hover:shadow-lg hover:bg-gray-200 font-semibold text-xs transition-all duration-300 transform hover:-translate-y-0.5">
                                                    Edit
                                                </a>
                                            </div>
                                            <form action="{{ route('admin.employees.toggleStatus', $employee->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="p-2 hover:bg-purple-100 rounded-xl hover:shadow-md transition-all duration-200 text-purple-600 hover:text-purple-700 {{ $employee->is_active ? '' : 'text-emerald-600 hover:text-emerald-700' }}" title="{{ $employee->is_active ? 'Pause' : 'Activate' }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.636 5.636a9 9 0 010 12.728M12 9v3.5m0 3.5v-3.5m0-.5h3.5m-3.5 0H9" {{ $employee->is_active ? '' : 'class="rotate-180"' }} />
                                                    </svg>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.employees.destroy', $employee->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this company?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="p-2 hover:bg-red-100 rounded-xl hover:shadow-md transition-all duration-200 text-red-600 hover:text-red-700" title="Delete">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-20 text-center">
                                        <div class="text-center py-12">
                                            <svg class="mx-auto h-16 w-16 text-slate-400 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                            </svg>
                                            <h3 class="text-lg font-bold text-slate-900 mb-2">No companies found</h3>
                                            <p class="text-slate-500">Get started by adding companies to your platform.</p>
                                            <a href="{{ route('admin.employees.create') }}" class="mt-4 inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-500 to-indigo-600 text-white rounded-xl shadow-lg hover:shadow-xl hover:from-purple-600 hover:to-indigo-700 font-semibold text-sm transition-all duration-300 transform hover:-translate-y-0.5">
                                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                                </svg>
                                                Add First Company
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            @if($employees->hasPages())
            <div class="mt-12 flex justify-center">
                {{ $employees->links() }}
            </div>
            @endif
        </div>
    </div>

    <style>
        /* Custom scrollbar */
        .overflow-x-auto::-webkit-scrollbar {
            height: 8px;
        }
        .overflow-x-auto::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 4px;
        }
        .overflow-x-auto::-webkit-scrollbar-thumb {
            background: linear-gradient(to right, #a855f7, #7c3aed);
            border-radius: 4px;
        }
        .overflow-x-auto::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(to right, #9333ea, #6d28d9);
        }
    </style>
</x-app-layout>
