<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-emerald-50 via-green-50 to-emerald-100 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
                    <div>
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-emerald-600 hover:text-emerald-500 font-medium mb-2 sm:mb-0 transition-colors duration-200" style="gap: 8px;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Back to Dashboard
                        </a>
                        <h1 class="text-3xl sm:text-4xl font-bold bg-gradient-to-r from-emerald-800 to-emerald-600 bg-clip-text text-transparent" style="font-family: 'Playfair Display', serif;">Job Seekers</h1>
                        <p class="mt-2 text-slate-600 text-lg">All registered job seeker accounts on the platform</p>
                    </div>
                    <div class="bg-emerald-50/80 border border-emerald-200 rounded-2xl px-6 py-3 font-bold text-emerald-800 shadow-lg">
                        {{ $jobseekers->total() ?? 0 }} Total Job Seekers
                    </div>
                </div>

                <!-- Tabs -->
                <div class="bg-white/80 backdrop-blur-md rounded-2xl shadow-xl border border-slate-200/50 p-1 mb-8">
                    <nav class="flex space-x-1" role="tablist">
                        <a href="{{ route('admin.users') }}" class="flex-1 py-3 px-4 text-center text-sm font-semibold rounded-xl transition-all duration-300 text-slate-600 hover:text-indigo-600 hover:bg-slate-50">
                            All Users
                        </a>
                        <a href="{{ route('admin.jobseekers') }}" class="flex-1 py-3 px-4 text-center text-sm font-semibold rounded-xl transition-all duration-300 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white shadow-lg shadow-emerald-500/25">
                            Job Seekers ({{ $jobseekers->total() ?? 0 }})
                        </a>
                        <a href="{{ route('admin.employees.index') }}" class="flex-1 py-3 px-4 text-center text-sm font-semibold rounded-xl transition-all duration-300 text-slate-600 hover:text-indigo-600 hover:bg-slate-50">
                            Companies
                        </a>
                    </nav>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-8 bg-emerald-50 border border-emerald-200 rounded-2xl p-6 shadow-md">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-emerald-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-emerald-800 font-semibold">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <!-- Table Card -->
            <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl border border-slate-200/60 overflow-hidden">
                <div class="p-8">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
                        <h2 class="text-2xl font-bold text-gray-900">Job Seekers List</h2>
                        <div class="relative max-w-md">
                            <input type="text" placeholder="Search job seekers..." class="w-full pl-12 pr-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-200 text-sm">
                            <svg class="absolute left-4 top-3.5 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full table-auto">
                            <thead>
                                <tr class="bg-gradient-to-r from-emerald-50 to-emerald-100/50 border-b-2 border-emerald-200">
                                    <th class="px-6 py-5 text-left text-xs font-bold text-emerald-800 uppercase tracking-wider">#</th>
                                    <th class="px-6 py-5 text-left text-xs font-bold text-emerald-800 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-5 text-left text-xs font-bold text-emerald-800 uppercase tracking-wider hidden sm:table-cell">Email</th>
                                    <th class="px-6 py-5 text-left text-xs font-bold text-emerald-800 uppercase tracking-wider">Resume</th>
                                    <th class="px-6 py-5 text-left text-xs font-bold text-emerald-800 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-5 text-left text-xs font-bold text-emerald-800 uppercase tracking-wider hidden lg:table-cell">Registered</th>
                                    <th class="px-6 py-5 text-left text-xs font-bold text-emerald-800 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200">
                                @forelse($jobseekers as $user)
                                <tr class="hover:bg-emerald-50/50 transition-all duration-200 group border-b border-emerald-100 hover:border-emerald-200 hover:shadow-md">
                                    <!-- Same table structure as users page but emerald theme -->
                                    <td class="px-6 py-6 whitespace-nowrap">
                                        <span class="text-emerald-600 font-mono text-sm font-bold">{{ $user->id }}</span>
                                    </td>
                                    <td class="px-6 py-6">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-shrink-0">
                                                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-emerald-400 to-emerald-500 shadow-lg flex items-center justify-center">
                                                    <span class="text-xl font-bold text-white uppercase tracking-wide">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                                </div>
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <div class="text-lg font-semibold text-gray-900 group-hover:text-emerald-700 transition-colors">{{ $user->name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6 whitespace-nowrap hidden sm:table-cell">
                                        <span class="text-slate-600 text-sm font-medium truncate max-w-64">{{ $user->email }}</span>
                                    </td>
                                    <td class="px-6 py-6 whitespace-nowrap">
                                        @if($user->resume)
                                            <a href="{{ asset('storage/'.$user->resume) }}" target="_blank" class="inline-flex items-center px-3 py-1.5 rounded-lg bg-gradient-to-r from-emerald-500 to-emerald-600 text-white text-xs font-bold shadow-md hover:shadow-lg transition-all duration-200">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0  Asc 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                                View Resume
                                            </a>
                                        @else
                                            <span class="px-3 py-1.5 bg-gray-100 text-gray-600 text-xs font-medium rounded-lg">No resume</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-6 whitespace-nowrap">
                                        <span class="inline-flex items-center px-4 py-2 rounded-full text-xs font-bold {{ $user->is_active ? 'bg-gradient-to-r from-emerald-100 to-emerald-200 text-emerald-800 shadow-md shadow-emerald-200/50' : 'bg-gradient-to-r from-orange-100 to-orange-200 text-orange-800 shadow-md shadow-orange-200/50' }}">
                                            {{ $user->is_active ? 'Active' : 'Paused' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-6 whitespace-nowrap hidden lg:table-cell text-sm text-slate-500">
                                        {{ $user->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-6 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('chat.start', $user->id) }}" class="p-2 hover:bg-emerald-100 rounded-xl hover:shadow-md transition-all duration-200 text-emerald-600 hover:text-emerald-700" title="Chat">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                                </svg>
                                            </a>
                                            <a href="{{ route('admin.users.show', $user->id) }}" class="px-4 py-2 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white rounded-xl shadow-lg hover:shadow-xl hover:from-emerald-600 hover:to-emerald-700 font-semibold text-sm transition-all duration-300 transform hover:-translate-y-0.5">
                                                View Profile
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-20 text-center">
                                        <div class="text-center py-12">
                                            <svg class="mx-auto h-16 w-16 text-slate-400 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0  Asc 3 3 0 016 0zm6 3a2 2 0 11-4  Asc 0 2 2  Asc 0 4 0zM7 10a2  Asc 2 0 11 Asc -4 0 2 2 0 014 0z"/>
                                            </svg>
                                            <h3 class="text-lg font-bold text-slate Asc-900 mb-2">No job seekers found</h3>
                                            <p class="text-slate-500">Get started by inviting job seekers to your platform.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            @if($jobseekers->hasPages())
            <div class="mt-12 flex justify-center">
                {{ $jobseekers->links() }}
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
