@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <div>
        <h2 class="text-2xl font-bold">Analytics Overview</h2>
        <p class="text-white/60 mt-1">Monitor your platform's performance</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4">
        <div class="glass-card rounded-xl p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-red-500/20 flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-white/60 text-xs uppercase tracking-wider">Total Users</p>
                <p class="text-2xl font-bold">{{ $stats['users'] ?? 0 }}</p>
            </div>
        </div>

        <div class="glass-card rounded-xl p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-red-500/20 flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/>
                </svg>
            </div>
            <div>
                <p class="text-white/60 text-xs uppercase tracking-wider">Total Songs</p>
                <p class="text-2xl font-bold">{{ $stats['songs'] ?? 0 }}</p>
            </div>
        </div>

        <div class="glass-card rounded-xl p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-red-500/20 flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-white/60 text-xs uppercase tracking-wider">Total Plays</p>
                <p class="text-2xl font-bold">{{ $stats['plays'] ?? 0 }}</p>
            </div>
        </div>

        <div class="glass-card rounded-xl p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-red-500/20 flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <div>
                <p class="text-white/60 text-xs uppercase tracking-wider">Total Artists</p>
                <p class="text-2xl font-bold">{{ $stats['artists'] ?? 0 }}</p>
            </div>
        </div>

        <div class="glass-card rounded-xl p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-red-500/20 flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/>
                </svg>
            </div>
            <div>
                <p class="text-white/60 text-xs uppercase tracking-wider">Total Albums</p>
                <p class="text-2xl font-bold">{{ $stats['albums'] ?? 0 }}</p>
            </div>
        </div>

        <div class="glass-card rounded-xl p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-red-500/20 flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
            </div>
            <div>
                <p class="text-white/60 text-xs uppercase tracking-wider">Total Comments</p>
                <p class="text-2xl font-bold">{{ $stats['comments'] ?? 0 }}</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="glass-card rounded-xl p-6 lg:col-span-2">
            <h3 class="text-lg font-semibold mb-4">Recent Users</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-white/60 border-b border-white/10">
                            <th class="text-left py-3 px-2">Name</th>
                            <th class="text-left py-3 px-2">Email</th>
                            <th class="text-left py-3 px-2">Joined</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentUsers as $user)
                        <tr class="border-b border-white/5 hover:bg-white/5 transition-colors">
                            <td class="py-3 px-2">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-red-500 to-red-700 flex items-center justify-center text-xs font-bold">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <span class="font-medium">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-2 text-white/60">{{ $user->email }}</td>
                            <td class="py-3 px-2 text-white/60">{{ $user->created_at->diffForHumans() }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="py-8 text-center text-white/40">No users found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="glass-card rounded-xl p-6">
            <h3 class="text-lg font-semibold mb-4">Top Played Songs</h3>
            <div class="space-y-3">
                @forelse($topSongs as $song)
                <div class="flex items-center gap-3 p-2 rounded-lg hover:bg-white/5 transition-colors">
                    <div class="w-10 h-10 rounded-lg bg-surface flex-shrink-0 overflow-hidden">
                        @if($song->cover)
                        <img src="{{ asset('storage/' . $song->cover) }}" alt="{{ $song->title }}" class="w-full h-full object-cover">
                        @else
                        <div class="w-full h-full flex items-center justify-center bg-red-500/20">
                            <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55C7.79 13 6 14.79 6 17s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/>
                            </svg>
                        </div>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-sm truncate">{{ $song->title }}</p>
                        <p class="text-xs text-white/60 truncate">{{ $song->artist->name ?? 'Unknown' }}</p>
                    </div>
                    <span class="text-sm text-white/40">{{ $song->plays_count ?? $song->plays ?? 0 }}</span>
                </div>
                @empty
                <p class="text-center text-white/40 py-8">No songs found</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="glass-card rounded-xl p-6">
        <h3 class="text-lg font-semibold mb-4">Recent Songs</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-white/60 border-b border-white/10">
                        <th class="text-left py-3 px-2">Title</th>
                        <th class="text-left py-3 px-2">Artist</th>
                        <th class="text-left py-3 px-2">Album</th>
                        <th class="text-left py-3 px-2">Plays</th>
                        <th class="text-left py-3 px-2">Added</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentSongs as $song)
                    <tr class="border-b border-white/5 hover:bg-white/5 transition-colors">
                        <td class="py-3 px-2 font-medium">{{ $song->title }}</td>
                        <td class="py-3 px-2 text-white/60">{{ $song->artist->name ?? 'Unknown' }}</td>
                        <td class="py-3 px-2 text-white/60">{{ $song->album->title ?? '-' }}</td>
                        <td class="py-3 px-2 text-white/60">{{ $song->plays }}</td>
                        <td class="py-3 px-2 text-white/40">{{ $song->created_at->diffForHumans() }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-white/40">No songs found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
