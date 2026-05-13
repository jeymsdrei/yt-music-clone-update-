<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'MusicApp')) - Yt  Music</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-[#0a0a0a] text-white min-h-screen" x-data="{ sidebarOpen: false }">
    <div class="flex h-screen overflow-hidden">
        @include('partials.sidebar')

        <div class="flex flex-col flex-1 overflow-hidden lg:ml-64">
            <header class="fixed top-0 right-0 z-40 flex items-center h-16 px-4 border-b lg:left-64 bg-[#0a0a0a]/80 backdrop-blur-xl border-white/5">
                <button class="p-2 mr-4 lg:hidden hover:bg-white/10 rounded-xl" @click="sidebarOpen = !sidebarOpen">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                <div class="flex items-center flex-1 max-w-xl">
                    <div class="relative w-full">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <form action="{{ route('search') }}" method="GET" class="w-full">
                            <input type="search" name="q" placeholder="Search songs, artists, albums..." value="{{ request('q') }}" class="input-field pl-10" onkeydown="if(event.key==='Enter'){this.form.submit()}">
                        </form>
                    </div>
                </div>

                <div class="flex items-center ml-auto space-x-3">
                    <div class="relative" x-data="{ open: false }">
                        <button class="btn-ghost p-2 relative" @click="open = !open" @click.outside="open = false">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full hidden"></span>
                        </button>
                        <div x-show="open" x-cloak class="absolute right-0 mt-2 w-72 glass rounded-2xl border border-white/10 shadow-xl overflow-hidden" @click="open = false">
                            <div class="p-4 text-sm text-white/60 text-center">No new notifications</div>
                        </div>
                    </div>
                    <div class="relative pl-3 border-l border-white/10" x-data="{ open: false }">
                        <button @click="open = !open" @click.outside="open = false" class="flex items-center gap-2 cursor-pointer hover:opacity-80 transition-opacity">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-red-500 to-red-700 flex items-center justify-center text-sm font-bold">
                                {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                            </div>
                        </button>
                        <div x-show="open" x-cloak class="absolute right-0 mt-2 w-48 glass rounded-2xl border border-white/10 shadow-xl overflow-hidden" @click="open = false">
                            <a href="{{ route('profile') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-white/5 transition-colors text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                Profile
                            </a>
                            <a href="{{ route('settings') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-white/5 transition-colors text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                Settings
                            </a>
                            <hr class="border-white/5">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center gap-3 px-4 py-3 hover:bg-white/5 transition-colors text-sm w-full text-left text-red-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                    Sign Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto pt-16 pb-20">
                <div class="p-4 lg:p-6">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    @include('partials.player')

    @include('partials.toast')

    @stack('scripts')

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('player', () => ({
                currentTrack: null,
                isPlaying: false,
                volume: 1,
                progress: 0,
                duration: 0,
                currentTime: 0,
                queue: [],
                queueIndex: -1,
                shuffle: false,
                repeat: 'none',
            }));
        });
    </script>
</body>
</html>
