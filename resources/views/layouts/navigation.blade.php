<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span class="font-bold text-xl text-gray-800 dark:text-gray-200">JobSphere</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                                {{ __('Dashboard') }}
                            </x-nav-link>
                        @elseif(Auth::user()->role === 'employer')
                            <x-nav-link :href="route('employer.dashboard')" :active="request()->routeIs('employer.dashboard')">
                                {{ __('Dashboard') }}
                            </x-nav-link>
                        @else
                            <x-nav-link :href="route('user.dashboard')" :active="request()->routeIs('user.dashboard')">
                                {{ __('Dashboard') }}
                            </x-nav-link>
                        @endif
                    @endauth
                    
                    <!-- Job Listings Link - Visible to all -->
                    <x-nav-link :href="route('jobs.index')" :active="request()->routeIs('jobs.index')">
                        {{ __('Browse Jobs') }}
                    </x-nav-link>

                    <!-- Messages Link - Visible to authenticated users -->
                    @auth
                    <x-nav-link :href="route('chat.index')" :active="request()->routeIs('chat.index')">
                        {{ __('Messages') }}
                    </x-nav-link>
                    @endauth
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Role Badge -->
                        <div class="px-4 py-2 text-xs text-gray-500 uppercase tracking-wider">
                            {{ Auth::user()->role === 'admin' ? 'Administrator' : (Auth::user()->role === 'employer' ? 'Employer' : 'Job Seeker') }}
                        </div>
                        
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Chat Link -->
                        <x-dropdown-link :href="route('chat.index')">
                            {{ __('Messages') }}
                        </x-dropdown-link>

                        <!-- Role-specific links -->
                        @if(Auth::user()->role === 'employer')
                            <x-dropdown-link :href="route('employer.jobs.create')">
                                {{ __('Post a Job') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('employer.jobs.index')">
                                {{ __('My Jobs') }}
                            </x-dropdown-link>
                        @elseif(Auth::user()->role === 'user')
                            <x-dropdown-link :href="route('user.applications')">
                                {{ __('My Applications') }}
                            </x-dropdown-link>
                        @elseif(Auth::user()->role === 'admin')
                            <x-dropdown-link :href="route('admin.users')">
                                {{ __('Manage Users') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('admin.employees.index')">
                                {{ __('Manage Employees') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('admin.jobs')">
                                {{ __('Manage Jobs') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('admin.applications')">
                                {{ __('Manage Applications') }}
                            </x-dropdown-link>
                        @endif

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                @else
                <div class="flex items-center gap-4">
                    @if(Route::has('admin.login'))
                    <a href="{{ route('admin.login') }}" class="text-sm text-gray-700 dark:text-gray-300 underline">Admin Login</a>
                    @endif
                </div>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @auth
                @if(Auth::user()->role === 'admin')
                    <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                @elseif(Auth::user()->role === 'employer')
                    <x-responsive-nav-link :href="route('employer.dashboard')" :active="request()->routeIs('employer.dashboard')">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                @else
                    <x-responsive-nav-link :href="route('user.dashboard')" :active="request()->routeIs('user.dashboard')">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                @endif
                
                <x-responsive-nav-link :href="route('jobs.index')" :active="request()->routeIs('jobs.index')">
                    {{ __('Browse Jobs') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('chat.index')" :active="request()->routeIs('chat.index')">
                    {{ __('Messages') }}
                </x-responsive-nav-link>
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        @auth
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('chat.index')">
                    {{ __('Messages') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
        @endauth
    </div>
</nav>
