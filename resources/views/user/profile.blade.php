@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="space-y-8 fade-in">
    {{-- Cover & Profile Header --}}
    <div class="relative rounded-2xl overflow-hidden">
        <div class="h-48 md:h-64 bg-gradient-to-r from-red-900/50 via-red-800/20 to-[#1a1a1a]"></div>
        <div class="absolute bottom-0 left-0 right-0 p-6 md:p-8 flex flex-col md:flex-row md:items-end gap-4 md:gap-6">
            <div class="w-24 h-24 md:w-32 md:h-32 rounded-full overflow-hidden ring-4 ring-[#0a0a0a] -mt-12 md:-mt-16 flex-shrink-0">
                @if($user->avatar)
                <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                @else
                <div class="w-full h-full bg-gradient-to-br from-red-500 to-red-700 flex items-center justify-center">
                    <span class="text-3xl md:text-4xl font-bold text-white">{{ substr($user->name, 0, 1) }}</span>
                </div>
                @endif
            </div>
            <div class="flex-1 min-w-0">
                <h1 class="text-2xl md:text-3xl font-bold">{{ $user->name }}</h1>
                <p class="text-white/40">@ {{ $user->username ?? $user->name }}</p>
                @if($user->bio)
                <p class="text-sm text-white/60 mt-1 max-w-xl">{{ $user->bio }}</p>
                @endif
                <div class="flex items-center gap-5 mt-3 text-sm">
                    <span><strong class="text-white">{{ $user->playlists->count() ?? 0 }}</strong> <span class="text-white/40">Playlists</span></span>
                    <span><strong class="text-white">{{ $user->likes->count() ?? 0 }}</strong> <span class="text-white/40">Liked Songs</span></span>
                    <span><strong class="text-white">{{ $user->followers_count ?? 0 }}</strong> <span class="text-white/40">Followers</span></span>
                </div>
            </div>
            <a href="{{ route('settings') }}" class="btn-ghost border border-white/10 flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                Edit Profile
            </a>
        </div>
    </div>

    {{-- Tabs --}}
    @php $tab = request('tab', 'playlists'); @endphp
    <div class="flex items-center gap-1 border-b border-white/5">
        <a href="{{ route('profile', ['tab' => 'playlists']) }}" class="nav-link {{ $tab === 'playlists' ? 'active' : '' }}">Playlists</a>
        <a href="{{ route('profile', ['tab' => 'liked']) }}" class="nav-link {{ $tab === 'liked' ? 'active' : '' }}">Liked Songs</a>
        <a href="{{ route('profile', ['tab' => 'recent']) }}" class="nav-link {{ $tab === 'recent' ? 'active' : '' }}">Recently Played</a>
    </div>

    {{-- Playlists Tab --}}
    @if($tab === 'playlists')
        @if($user->playlists->count())
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($user->playlists as $playlist)
            <div class="music-card group">
                <div class="relative overflow-hidden rounded-xl aspect-square bg-white/5">
                    @if($playlist->cover_image)
                    <img src="{{ asset('storage/' . $playlist->cover_image) }}" alt="{{ $playlist->name }}" class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-110" loading="lazy">
                    @else
                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-red-500/10 to-red-700/10">
                        <svg class="w-16 h-16 text-white/10" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55C7.79 13 6 14.79 6 17s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/></svg>
                    </div>
                    @endif
                </div>
                <div class="mt-2.5">
                    <h3 class="text-sm font-medium truncate">
                        <a href="{{ route('playlists.show', $playlist) }}" class="hover:underline">{{ $playlist->name }}</a>
                    </h3>
                    <p class="text-xs text-white/40">{{ $playlist->songs_count ?? $playlist->songs->count() ?? 0 }} songs</p>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-16">
            <p class="text-white/40">No playlists created yet.</p>
        </div>
        @endif
    @endif

    {{-- Liked Tab --}}
    @if($tab === 'liked')
        @if($user->likes->count())
        <div class="space-y-1">
            @foreach($user->likes as $like)
            @php $song = $like->song; @endphp
            <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-white/5 transition-colors group">
                <div class="flex-shrink-0 w-12 h-12 rounded-lg overflow-hidden bg-white/5">
                    @if($song && $song->thumbnail_url)
                    <img src="{{ $song->thumbnail_url }}" alt="{{ $song->title }}" class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-white/20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55C7.79 13 6 14.79 6 17s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/></svg>
                    </div>
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <h3 class="text-sm font-medium truncate">{{ $song->title ?? 'Unknown' }}</h3>
                    <p class="text-xs text-white/40 truncate">{{ $song->artist->name ?? 'Unknown Artist' }}</p>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-16">
            <p class="text-white/40">No liked songs yet.</p>
        </div>
        @endif
    @endif

    {{-- Recently Played Tab --}}
    @if($tab === 'recent')
        @if($user->recentlyPlayed->count())
        <div class="space-y-1">
            @foreach($user->recentlyPlayed as $item)
            @php $song = $item->song; @endphp
            <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-white/5 transition-colors group">
                <div class="flex-shrink-0 w-12 h-12 rounded-lg overflow-hidden bg-white/5">
                    @if($song && $song->thumbnail_url)
                    <img src="{{ $song->thumbnail_url }}" alt="{{ $song->title }}" class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-white/20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55C7.79 13 6 14.79 6 17s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/></svg>
                    </div>
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <h3 class="text-sm font-medium truncate">{{ $song->title ?? 'Unknown' }}</h3>
                    <p class="text-xs text-white/40 truncate">{{ $song->artist->name ?? 'Unknown Artist' }}</p>
                </div>
                <button class="p-2 rounded-full hover:bg-white/10 transition-colors opacity-0 group-hover:opacity-100" data-action="play" data-song="{{ $song->id ?? '' }}" title="Play">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                </button>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-16">
            <p class="text-white/40">No recently played songs.</p>
        </div>
        @endif
    @endif
</div>
@endsection
