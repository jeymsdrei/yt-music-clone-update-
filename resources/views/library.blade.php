@extends('layouts.app')

@section('title', 'Library')

@section('content')
<div class="space-y-8 fade-in">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold">Your Library</h1>
            <p class="text-white/40 text-sm mt-1">Manage your music collection</p>
        </div>
        <a href="{{ route('playlists.create') }}" class="btn-primary shadow-lg shadow-red-500/25">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Create Playlist
        </a>
    </div>

    {{-- Tabs --}}
    @php $tab = request('tab', 'playlists'); @endphp
    <div class="flex items-center gap-1 border-b border-white/5 overflow-x-auto">
        <a href="{{ route('library', ['tab' => 'playlists']) }}" class="nav-link whitespace-nowrap {{ $tab === 'playlists' ? 'active' : '' }}">Playlists</a>
        <a href="{{ route('library', ['tab' => 'songs']) }}" class="nav-link whitespace-nowrap {{ $tab === 'songs' ? 'active' : '' }}">Songs</a>
        <a href="{{ route('library', ['tab' => 'albums']) }}" class="nav-link whitespace-nowrap {{ $tab === 'albums' ? 'active' : '' }}">Albums</a>
        <a href="{{ route('library', ['tab' => 'artists']) }}" class="nav-link whitespace-nowrap {{ $tab === 'artists' ? 'active' : '' }}">Artists</a>
        <a href="{{ route('library', ['tab' => 'liked']) }}" class="nav-link whitespace-nowrap {{ $tab === 'liked' ? 'active' : '' }}">Liked</a>
    </div>

    {{-- Playlists Tab --}}
    @if($tab === 'playlists')
        @if(isset($playlists) && $playlists->count())
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($playlists as $playlist)
            <div class="music-card group">
                <div class="relative overflow-hidden rounded-xl aspect-square bg-white/5">
                    @if($playlist->cover_image)
                    <img src="{{ asset('storage/' . $playlist->cover_image) }}" alt="{{ $playlist->name }}" class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-110" loading="lazy">
                    @else
                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-red-500/10 to-red-700/10">
                        <svg class="w-16 h-16 text-white/10" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55C7.79 13 6 14.79 6 17s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/></svg>
                    </div>
                    @endif
                    <div class="absolute inset-0 flex items-center justify-center transition-all duration-300 opacity-0 bg-black/30 group-hover:opacity-100">
                        <button class="flex items-center justify-center w-12 h-12 transition-transform rounded-full bg-red-500 hover:bg-red-400 hover:scale-110 shadow-lg shadow-red-500/25" data-action="play-playlist" data-playlist="{{ $playlist->id }}">
                            <svg class="w-6 h-6 text-white ml-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </button>
                    </div>
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
            <svg class="w-16 h-16 mx-auto text-white/10 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
            </svg>
            <p class="text-white/40 text-lg mb-4">No playlists yet</p>
            <a href="{{ route('playlists.create') }}" class="btn-primary">Create your first playlist</a>
        </div>
        @endif
    @endif

    {{-- Songs Tab --}}
    @if($tab === 'songs')
        @if(isset($recentlyPlayed) && $recentlyPlayed->count())
        <div class="space-y-1">
            @foreach($recentlyPlayed as $item)
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
                <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                    <button class="p-2 rounded-full hover:bg-white/10 transition-colors" data-action="play" data-song="{{ $song->id ?? '' }}" title="Play">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    </button>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-16">
            <svg class="w-16 h-16 mx-auto text-white/10 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2z"/>
            </svg>
            <p class="text-white/40 text-lg">No songs in your library.</p>
        </div>
        @endif
    @endif

    {{-- Albums Tab --}}
    @if($tab === 'albums')
        @if(isset($albums) && $albums->count())
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($albums as $album)
            <div class="music-card group">
                <div class="relative overflow-hidden rounded-xl aspect-square bg-white/5">
                    @if($album->cover_url)
                    <img src="{{ $album->cover_url }}" alt="{{ $album->title }}" class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-110" loading="lazy">
                    @else
                    <div class="flex items-center justify-center w-full h-full">
                        <svg class="w-12 h-12 text-white/20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55C7.79 13 6 14.79 6 17s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/></svg>
                    </div>
                    @endif
                </div>
                <div class="mt-2.5">
                    <h3 class="text-sm font-medium truncate">
                        <a href="{{ route('albums.show', $album) }}" class="hover:underline">{{ $album->title }}</a>
                    </h3>
                    <p class="text-xs truncate text-white/40">{{ $album->artist->name ?? 'Various Artists' }}</p>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-16">
            <p class="text-white/40 text-lg">No albums in your library.</p>
        </div>
        @endif
    @endif

    {{-- Artists Tab --}}
    @if($tab === 'artists')
        @if(isset($artists) && $artists->count())
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($artists as $artist)
            <a href="{{ route('artists.show', $artist) }}" class="group text-center">
                <div class="w-32 h-32 mx-auto rounded-full overflow-hidden bg-white/5 mb-3 ring-2 ring-transparent group-hover:ring-red-500/50 transition-all">
                    @if($artist->image_url)
                    <img src="{{ $artist->image_url }}" alt="{{ $artist->name }}" class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-red-500/20 to-red-700/20">
                        <span class="text-3xl font-bold text-white/30">{{ substr($artist->name, 0, 1) }}</span>
                    </div>
                    @endif
                </div>
                <h3 class="text-sm font-medium truncate">{{ $artist->name }}</h3>
                <p class="text-xs text-white/40">Artist</p>
            </a>
            @endforeach
        </div>
        @else
        <div class="text-center py-16">
            <p class="text-white/40 text-lg">No artists in your library.</p>
        </div>
        @endif
    @endif

    {{-- Liked Tab --}}
    @if($tab === 'liked')
        @if(isset($likes) && $likes->count())
        <div class="space-y-1">
            @foreach($likes as $like)
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
                @if($song && isset($song->duration))
                <span class="text-xs text-white/30">{{ gmdate('i:s', $song->duration) }}</span>
                @endif
                <button class="p-2 rounded-full hover:bg-white/10 text-red-500 transition-colors" data-action="unlike" data-song="{{ $like->song_id }}" title="Unlike">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                </button>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-16">
            <svg class="w-16 h-16 mx-auto text-white/10 mb-4" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
            </svg>
            <p class="text-white/40 text-lg">No liked songs yet.</p>
            <p class="text-white/20 text-sm mt-1">Tap the heart icon on any song to add it here.</p>
        </div>
        @endif
    @endif
</div>
@endsection
