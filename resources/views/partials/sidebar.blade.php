<aside class="fixed inset-y-0 left-0 z-50 flex flex-col w-64 bg-[#0f0f0f] border-r border-white/5 transition-transform duration-300 -translate-x-full lg:translate-x-0" :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
    <div class="flex items-center h-16 px-6 border-b border-white/5">
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-red-500 to-red-700 flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55C7.79 13 6 14.79 6 17s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/>
                </svg>
            </div>
            <span class="text-lg font-bold">MusicApp</span>
        </a>
    </div>

    <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
        <div class="mb-2 text-xs font-semibold tracking-wider text-white/40 uppercase px-3">Browse</div>
        <a href="{{ route('home') }}" class="sidebar-link @if(request()->routeIs('home')) active @endif">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            <span>Home</span>
        </a>
        <a href="{{ route('explore') }}" class="sidebar-link @if(request()->routeIs('explore')) active @endif">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <span>Explore</span>
        </a>
        <a href="{{ route('trending') }}" class="sidebar-link @if(request()->routeIs('trending')) active @endif">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
            </svg>
            <span>Trending</span>
        </a>
        <a href="{{ route('library') }}" class="sidebar-link @if(request()->routeIs('library')) active @endif">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
            </svg>
            <span>Library</span>
        </a>

        <div class="pt-4 mt-4 border-t border-white/5">
            <div class="flex items-center justify-between mb-2 px-3">
                <span class="text-xs font-semibold tracking-wider text-white/40 uppercase">Your Library</span>
                <a href="{{ route('playlists.create') }}" class="p-1 text-white/40 hover:text-white transition-colors" title="New Playlist">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </a>
            </div>
            <a href="{{ route('liked-songs') }}" class="sidebar-link">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
                <span>Liked Songs</span>
            </a>
            <a href="{{ route('recently-played') }}" class="sidebar-link">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>Recently Played</span>
            </a>
            <a href="{{ route('playlists.index') }}" class="sidebar-link">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                </svg>
                <span>Playlists</span>
            </a>
        </div>

        <div class="pt-4 mt-4 border-t border-white/5" id="user-playlists">
            <div class="mb-2 text-xs font-semibold tracking-wider text-white/40 uppercase px-3">My Playlists</div>
            @if(isset($playlists) && $playlists->count())
                @foreach($playlists as $playlist)
                    <a href="{{ route('playlists.show', $playlist) }}" class="sidebar-link text-sm">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2z"/>
                        </svg>
                        <span class="truncate">{{ $playlist->name }}</span>
                    </a>
                @endforeach
            @else
                <p class="px-3 text-xs text-white/30">No playlists yet</p>
            @endif
        </div>
    </nav>

    <div class="p-3 border-t border-white/5">
        <a href="{{ route('profile') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-white/5 transition-colors">
            <div class="flex-shrink-0 w-8 h-8 rounded-full bg-gradient-to-br from-red-500 to-red-700 flex items-center justify-center text-sm font-bold">
                {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-sm font-medium truncate">{{ Auth::user()->name ?? 'User' }}</p>
                <p class="text-xs text-white/40 truncate">{{ Auth::user()->email ?? '' }}</p>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="p-1 text-white/40 hover:text-white transition-colors" title="Logout">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                </button>
            </form>
        </a>
    </div>

    <div class="fixed inset-0 z-40 bg-black/50 lg:hidden" x-show="sidebarOpen" @click="sidebarOpen = false" x-cloak></div>
</aside>
