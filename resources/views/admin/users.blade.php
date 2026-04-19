<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
                    <div>
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-500 font-medium mb-2 sm:mb-0 transition-colors duration-200" style="gap: 8px;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Back to Dashboard
                        </a>
                        <h1 class="text-3xl sm:text-4xl font-bold bg-gradient-to-r from-gray-900 to-slate-800 bg-clip-text text-transparent" style="font-family: 'Playfair Display', serif;">Manage Users</h1>
                        <p class="mt-2 text-slate-600 text-lg">View, manage and monitor all registered platform users</p>
                    </div>
                </div>

                <!-- Enhanced Tabs -->
                <div class="bg-white/80 backdrop-blur-md rounded-2xl shadow-xl border border-slate-200/50 p-1 mb-8">
                    <nav class="flex space-x-1" role="tablist">
                        <a href="{{ route('admin.users') }}" class="flex-1 py-3 px-4 text-center text-sm font-semibold rounded-xl transition-all duration-300 {{ request()->routeIs('admin.users') ? 'bg-gradient-to-r from-indigo-500 to-blue-600 text-white shadow-lg shadow-indigo-500/25' : 'text-slate-600 hover:text-indigo-600 hover:bg-slate-50' }}">
                            All Users ({{ $users->total() ?? 0 }})
                        </a>
                        <a href="{{ route('admin.jobseekers') }}" class="flex-1 py-3 px-4 text-center text-sm font-semibold rounded-xl transition-all duration-300 {{ request()->routeIs('admin.jobseekers') ? 'bg-gradient-to-r from-indigo-500 to-blue-600 text-white shadow-lg shadow-indigo-500/25' : 'text-slate-600 hover:text-indigo-600 hover:bg-slate-50' }}">
                            Job Seekers
                        </a>
                        <a href="{{ route('admin.employees.index') }}" class="flex-1 py-3 px-4 text-center text-sm font-semibold rounded-xl transition-all duration-300 text-slate-600 hover:text-indigo-600 hover:bg-slate-50">
                            Companies
                        </a>
                    </nav>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-8 bg-green-50 border border-green-200 rounded-2xl p-6 shadow-md">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-green-800 font-semibold">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <!-- Search & Stats Card -->
            <div class="bg-white/80 backdrop-blur-lg rounded-3xl shadow-2xl border border-slate-200/50 p-8 mb-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="text-center bg-gradient-to-br from-indigo-500/10 to-blue-500/10 p-6 rounded-2xl border border-indigo-200/50">
                        <div class="text-3xl font-bold text-indigo-600">{{ $users->total() ?? 0 }}</div>
                        <div class="text-slate-600 font-medium mt-1">Total Users</div>
                    </div>
                    <!-- Add more stats if available -->
                </div>
            </div>

            <!-- Users Table Card -->
            <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl border border-slate-200/60 overflow-hidden">
                <div class="p-8">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
                        <h2 class="text-2xl font-bold text-gray-900">Users List</h2>
                        <div class="relative max-w-md">
                            <input type="text" placeholder="Search users..." class="w-full pl-12 pr-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 text-sm">
                            <svg class="absolute left-4 top-3.5 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full table-auto">
                            <thead>
                                <tr class="bg-gradient-to-r from-slate-50 to-slate-100/50 border-b-2 border-slate-200">
                                    <th class="px-6 py-5 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">#</th>
                                    <th class="px-6 py-5 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-5 text-left text-xs font-bold text-slate-700 uppercase tracking-wider hidden sm:table-cell">Email</th>
                                    <th class="px-6 py-5 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Role</th>
                                    <th class="px-6 py-5 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-5 text-left text-xs font-bold text-slate-700 uppercase tracking-wider hidden lg:table-cell">Registered</th>
                                    <th class="px-6 py-5 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200">
                                @forelse($users as $user)
                                <tr class="hover:bg-indigo-50/50 transition-all duration-200 group border-b border-slate-100 hover:border-indigo-200 hover:shadow-md">
                                    <td class="px-6 py-6 whitespace-nowrap">
                                        <span class="text-slate-500 font-mono text-sm font-medium">{{ $user->id }}</span>
                                    </td>
                                    <td class="px-6 py-6">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-shrink-0">
                                                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br {{ $user->role === 'employer' ? 'from-emerald-400 to-emerald-500' : 'from-indigo-400 to-indigo-500' }} shadow-lg flex items-center justify-center">
                                                    <span class="text-xl font-bold text-white uppercase tracking-wide">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                                </div>
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <div class="text-lg font-semibold text-gray-900 group-hover:text-indigo-700 transition-colors">{{ $user->name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6 whitespace-nowrap hidden sm:table-cell">
                                        <span class="text-slate-600 text-sm font-medium truncate max-w-64">{{ $user->email }}</span>
                                    </td>
                                    <td class="px-6 py-6 whitespace-nowrap">
                                        <span class="inline-flex items-center px-4 py-2 rounded-full text-xs font-bold bg-gradient-to-r {{ $user->role === 'employer' ? 'from-emerald-100 to-emerald-200 text-emerald-800' : 'from-blue-100 to-blue-200 text-blue-800' }} shadow-md shadow-emerald-200/50">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-6 whitespace-nowrap">
                                        <span class="inline-flex items-center px-4 py-2 rounded-full text-xs font-bold {{ $user->is_active ? 'bg-gradient-to-r from-emerald-100 to-emerald-200 text-emerald-800 shadow-md shadow-emerald-200/50' : 'bg-gradient-to-r from-orange-100 to-orange-200 text-orange-800 shadow-md shadow-orange-200/50' }}">
                                            {{ $user->is_active ? 'Active' : 'Paused' }}
                                            @if(!$user->is_active)
                                            <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                            @endif
                                        </span>
                                    </td>
                                    <td class="px-6 py-6 whitespace-nowrap hidden lg:table-cell text-sm text-slate-500">
                                        {{ $user->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-6 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('chat.start', $user->id) }}" class="p-2 hover:bg-indigo-100 rounded-xl hover:shadow-md transition-all duration-200 text-indigo-600 hover:text-indigo-700" title="Chat">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                                </svg>
                                            </a>
                                            <a href="{{ route('admin.users.show', $user->id) }}" class="px-4 py-2 bg-gradient-to-r from-indigo-500 to-blue-600 text-white rounded-xl shadow-lg hover:shadow-xl hover:from-indigo-600 hover:to-blue-700 font-semibold text-sm transition-all duration-300 transform hover:-translate-y-0.5">
                                                View
                                            </a>
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
                                            <h3 class="text-lg font-bold text-slate-900 mb-2">No users found</h3>
                                            <p class="text-slate-500">No users match your current filters.</p>
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
            @if($users->hasPages())
            <div class="mt-12 flex justify-center">
                {{ $users->links() }}
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
            background: linear-gradient(to right, #6366f1, #3b82f6);
            border-radius: 4px;
        }
        .overflow-x-auto::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(to right, #4f46e5, #2563eb);
        }
    </style>
</x-app-layout>
