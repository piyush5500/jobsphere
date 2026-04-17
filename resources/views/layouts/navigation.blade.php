<nav x-data="{ open: false, dropOpen: false }" style="background: #2c3e50; border-bottom: 3px solid #3498db; position: sticky; top: 0; z-index: 100; box-shadow: 0 2px 8px rgba(0,0,0,0.2);">
    <div style="max-width: 1400px; margin: 0 auto; padding: 0 24px;">
        <div style="display: flex; justify-content: space-between; align-items: center; height: 64px;">

            <!-- Logo -->
            <a href="{{ route('dashboard') }}" style="display: flex; align-items: center; gap: 10px; text-decoration: none;">
                <div style="width: 36px; height: 36px; background: #3498db; border-radius: 6px; display: flex; align-items: center; justify-content: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:20px;height:20px;color:white;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <span style="font-family: 'Playfair Display', serif; font-size: 1.3rem; font-weight: 700; color: white; letter-spacing: 0.5px;">JobSphere</span>
            </a>

            <!-- Desktop Nav Links -->
            <div style="display: flex; align-items: center; gap: 6px;" class="hidden sm:flex">
                @auth
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" style="padding: 8px 16px; color: {{ request()->routeIs('admin.dashboard') ? '#3498db' : 'rgba(255,255,255,0.8)' }}; text-decoration: none; font-size: 0.9rem; font-weight: 500; border-bottom: 2px solid {{ request()->routeIs('admin.dashboard') ? '#3498db' : 'transparent' }}; transition: all 0.2s;">Dashboard</a>
                    @elseif(Auth::user()->role === 'employer')
                        <a href="{{ route('employer.dashboard') }}" style="padding: 8px 16px; color: {{ request()->routeIs('employer.dashboard') ? '#3498db' : 'rgba(255,255,255,0.8)' }}; text-decoration: none; font-size: 0.9rem; font-weight: 500; border-bottom: 2px solid {{ request()->routeIs('employer.dashboard') ? '#3498db' : 'transparent' }}; transition: all 0.2s;">Dashboard</a>
                    @else
                        <a href="{{ route('user.dashboard') }}" style="padding: 8px 16px; color: {{ request()->routeIs('user.dashboard') ? '#3498db' : 'rgba(255,255,255,0.8)' }}; text-decoration: none; font-size: 0.9rem; font-weight: 500; border-bottom: 2px solid {{ request()->routeIs('user.dashboard') ? '#3498db' : 'transparent' }}; transition: all 0.2s;">Dashboard</a>
                    @endif
                @endauth

                <a href="{{ route('jobs.index') }}" style="padding: 8px 16px; color: {{ request()->routeIs('jobs.index') ? '#3498db' : 'rgba(255,255,255,0.8)' }}; text-decoration: none; font-size: 0.9rem; font-weight: 500; border-bottom: 2px solid {{ request()->routeIs('jobs.index') ? '#3498db' : 'transparent' }}; transition: all 0.2s;">Browse Jobs</a>

                @auth
                <a href="{{ route('chat.index') }}" style="padding: 8px 16px; color: {{ request()->routeIs('chat.*') ? '#3498db' : 'rgba(255,255,255,0.8)' }}; text-decoration: none; font-size: 0.9rem; font-weight: 500; border-bottom: 2px solid {{ request()->routeIs('chat.*') ? '#3498db' : 'transparent' }}; transition: all 0.2s;">Messages</a>
                @endauth
            </div>

            <!-- Right Side -->
            <div style="display: flex; align-items: center; gap: 12px;">
                @auth
                <!-- User Dropdown -->
                <div style="position: relative;" x-data="{ dropOpen: false }">
                    <button @click="dropOpen = !dropOpen" style="display: flex; align-items: center; gap: 10px; background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); border-radius: 6px; padding: 8px 14px; cursor: pointer; color: white; font-size: 0.9rem; transition: background 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.15)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'">
                        <div style="width: 28px; height: 28px; background: #3498db; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.8rem;">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <span style="max-width: 120px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ Auth::user()->name }}</span>
                        <svg style="width:14px;height:14px;transition:transform 0.2s;" :style="dropOpen ? 'transform:rotate(180deg)' : ''" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>

                    <div x-show="dropOpen" @click.away="dropOpen = false" x-transition style="position: absolute; right: 0; top: calc(100% + 8px); background: white; border: 1px solid #dcdde1; border-radius: 6px; box-shadow: 0 8px 24px rgba(0,0,0,0.12); min-width: 220px; z-index: 200; overflow: hidden;">
                        <!-- User Info -->
                        <div style="padding: 14px 16px; background: #f8f9fa; border-bottom: 1px solid #dcdde1;">
                            <div style="font-weight: 600; color: #2c3e50; font-size: 0.9rem;">{{ Auth::user()->name }}</div>
                            <div style="font-size: 0.78rem; color: #7f8c8d; margin-top: 2px;">{{ Auth::user()->email }}</div>
                            <span style="display: inline-block; margin-top: 6px; padding: 2px 10px; border-radius: 20px; font-size: 0.72rem; font-weight: 600; background: {{ Auth::user()->role === 'admin' ? '#fde8e8' : (Auth::user()->role === 'employer' ? '#e8f4fc' : '#e8f8f0') }}; color: {{ Auth::user()->role === 'admin' ? '#c0392b' : (Auth::user()->role === 'employer' ? '#2980b9' : '#27ae60') }};">
                                {{ ucfirst(Auth::user()->role) }}
                            </span>
                        </div>

                        <!-- Links -->
                        <div style="padding: 6px 0;">
                            <a href="{{ route('profile.edit') }}" style="display: flex; align-items: center; gap: 10px; padding: 10px 16px; color: #2c3e50; text-decoration: none; font-size: 0.88rem; transition: background 0.15s;" onmouseover="this.style.background='#f5f6fa'" onmouseout="this.style.background='transparent'">
                                <svg style="width:15px;height:15px;color:#7f8c8d;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                Profile
                            </a>
                            <a href="{{ route('chat.index') }}" style="display: flex; align-items: center; gap: 10px; padding: 10px 16px; color: #2c3e50; text-decoration: none; font-size: 0.88rem; transition: background 0.15s;" onmouseover="this.style.background='#f5f6fa'" onmouseout="this.style.background='transparent'">
                                <svg style="width:15px;height:15px;color:#7f8c8d;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                Messages
                            </a>

                            @if(Auth::user()->role === 'employer')
                            <a href="{{ route('employer.jobs.create') }}" style="display: flex; align-items: center; gap: 10px; padding: 10px 16px; color: #2c3e50; text-decoration: none; font-size: 0.88rem; transition: background 0.15s;" onmouseover="this.style.background='#f5f6fa'" onmouseout="this.style.background='transparent'">
                                <svg style="width:15px;height:15px;color:#7f8c8d;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                Post a Job
                            </a>
                            <a href="{{ route('employer.jobs.index') }}" style="display: flex; align-items: center; gap: 10px; padding: 10px 16px; color: #2c3e50; text-decoration: none; font-size: 0.88rem; transition: background 0.15s;" onmouseover="this.style.background='#f5f6fa'" onmouseout="this.style.background='transparent'">
                                <svg style="width:15px;height:15px;color:#7f8c8d;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                My Jobs
                            </a>
                            @elseif(Auth::user()->role === 'user')
                            <a href="{{ route('user.applications') }}" style="display: flex; align-items: center; gap: 10px; padding: 10px 16px; color: #2c3e50; text-decoration: none; font-size: 0.88rem; transition: background 0.15s;" onmouseover="this.style.background='#f5f6fa'" onmouseout="this.style.background='transparent'">
                                <svg style="width:15px;height:15px;color:#7f8c8d;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                My Applications
                            </a>
                            @elseif(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.users') }}" style="display: flex; align-items: center; gap: 10px; padding: 10px 16px; color: #2c3e50; text-decoration: none; font-size: 0.88rem; transition: background 0.15s;" onmouseover="this.style.background='#f5f6fa'" onmouseout="this.style.background='transparent'">
                                <svg style="width:15px;height:15px;color:#7f8c8d;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                Manage Users
                            </a>
                            <a href="{{ route('admin.jobs') }}" style="display: flex; align-items: center; gap: 10px; padding: 10px 16px; color: #2c3e50; text-decoration: none; font-size: 0.88rem; transition: background 0.15s;" onmouseover="this.style.background='#f5f6fa'" onmouseout="this.style.background='transparent'">
                                <svg style="width:15px;height:15px;color:#7f8c8d;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                Manage Jobs
                            </a>
                            @endif
                        </div>

                        <!-- Logout -->
                        <div style="border-top: 1px solid #dcdde1; padding: 6px 0;">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" style="display: flex; align-items: center; gap: 10px; width: 100%; padding: 10px 16px; background: none; border: none; color: #e74c3c; font-size: 0.88rem; cursor: pointer; text-align: left; transition: background 0.15s;" onmouseover="this.style.background='#fde8e8'" onmouseout="this.style.background='transparent'">
                                    <svg style="width:15px;height:15px;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @else
                <a href="{{ route('login') }}" style="padding: 8px 18px; color: rgba(255,255,255,0.85); text-decoration: none; font-size: 0.9rem; font-weight: 500; border: 1px solid rgba(255,255,255,0.3); border-radius: 4px; transition: all 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.1)'" onmouseout="this.style.background='transparent'">Log In</a>
                @if(Route::has('register'))
                <a href="{{ route('register') }}" style="padding: 8px 18px; background: #3498db; color: white; text-decoration: none; font-size: 0.9rem; font-weight: 600; border-radius: 4px; transition: background 0.2s;" onmouseover="this.style.background='#2980b9'" onmouseout="this.style.background='#3498db'">Register</a>
                @endif
                @endauth

                <!-- Mobile Hamburger -->
                <button @click="open = !open" style="display: none; background: none; border: none; color: white; cursor: pointer; padding: 4px;" class="sm:hidden">
                    <svg style="width:24px;height:24px;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path :class="{'hidden': open}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': !open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" style="background: #34495e; border-top: 1px solid rgba(255,255,255,0.1);" class="sm:hidden">
        <div style="padding: 12px 16px; display: flex; flex-direction: column; gap: 4px;">
            @auth
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" style="padding: 10px 12px; color: rgba(255,255,255,0.85); text-decoration: none; font-size: 0.9rem; border-radius: 4px;">Dashboard</a>
                @elseif(Auth::user()->role === 'employer')
                    <a href="{{ route('employer.dashboard') }}" style="padding: 10px 12px; color: rgba(255,255,255,0.85); text-decoration: none; font-size: 0.9rem; border-radius: 4px;">Dashboard</a>
                @else
                    <a href="{{ route('user.dashboard') }}" style="padding: 10px 12px; color: rgba(255,255,255,0.85); text-decoration: none; font-size: 0.9rem; border-radius: 4px;">Dashboard</a>
                @endif
            @endauth
            <a href="{{ route('jobs.index') }}" style="padding: 10px 12px; color: rgba(255,255,255,0.85); text-decoration: none; font-size: 0.9rem; border-radius: 4px;">Browse Jobs</a>
            @auth
            <a href="{{ route('chat.index') }}" style="padding: 10px 12px; color: rgba(255,255,255,0.85); text-decoration: none; font-size: 0.9rem; border-radius: 4px;">Messages</a>
            <a href="{{ route('profile.edit') }}" style="padding: 10px 12px; color: rgba(255,255,255,0.85); text-decoration: none; font-size: 0.9rem; border-radius: 4px;">Profile</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" style="width: 100%; text-align: left; padding: 10px 12px; background: none; border: none; color: #e74c3c; font-size: 0.9rem; cursor: pointer; border-radius: 4px;">Log Out</button>
            </form>
            @else
            <a href="{{ route('login') }}" style="padding: 10px 12px; color: rgba(255,255,255,0.85); text-decoration: none; font-size: 0.9rem;">Log In</a>
            <a href="{{ route('register') }}" style="padding: 10px 12px; color: rgba(255,255,255,0.85); text-decoration: none; font-size: 0.9rem;">Register</a>
            @endauth
        </div>
    </div>
</nav>
