@extends('layouts.app')

@section('title', 'Playlists')

@section('content')
<div class="space-y-10 fade-in">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold">Playlists</h1>
            <p class="text-white/40 text-sm mt-1">Discover and manage your playlists</p>
        </div>
        <a href="{{ route('playlists.create') }}" class="btn-primary shadow-lg shadow-red-500/25">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            New Playlist
        </a>
    </div>

    @if($userPlaylists->count())
    <section>
        <h2 class="text-lg font-semibold mb-4">Your Playlists</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
            @foreach($userPlaylists as $playlist)
            <a href="{{ route('playlists.show', $playlist) }}" class="music-card group block">
                <div class="relative overflow-hidden rounded-xl aspect-square bg-white/5">
                    @if($playlist->cover_image)
                    <img src="{{ asset('storage/' . $playlist->cover_image) }}" alt="{{ $playlist->name }}" class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-110" loading="lazy">
                    @else
                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-red-500/10 to-purple-500/10">
                        <svg class="w-16 h-16 text-white/10" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55C7.79 13 6 14.79 6 17s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/></svg>
                    </div>
                    @endif
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                        <div class="w-12 h-12 rounded-full bg-red-500 flex items-center justify-center shadow-lg shadow-red-500/50 transform translate-y-4 group-hover:translate-y-0 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </div>
                </div>
                <div class="mt-2.5 px-1">
                    <h3 class="text-sm font-medium truncate">{{ $playlist->name }}</h3>
                    <p class="text-xs text-white/40">{{ $playlist->songs_count }} songs</p>
                </div>
            </a>
            @endforeach
        </div>
    </section>
    @endif

    @if($publicPlaylists->count())
    <section>
        <h2 class="text-lg font-semibold mb-4">Public Playlists</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
            @foreach($publicPlaylists as $playlist)
            <a href="{{ route('playlists.show', $playlist) }}" class="music-card group block">
                <div class="relative overflow-hidden rounded-xl aspect-square bg-white/5">
                    @if($playlist->cover_image)
                    <img src="{{ asset('storage/' . $playlist->cover_image) }}" alt="{{ $playlist->name }}" class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-110" loading="lazy">
                    @else
                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-500/10 to-green-500/10">
                        <svg class="w-16 h-16 text-white/10" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55C7.79 13 6 14.79 6 17s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/></svg>
                    </div>
                    @endif
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                        <div class="w-12 h-12 rounded-full bg-red-500 flex items-center justify-center shadow-lg shadow-red-500/50 transform translate-y-4 group-hover:translate-y-0 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </div>
                </div>
                <div class="mt-2.5 px-1">
                    <h3 class="text-sm font-medium truncate">{{ $playlist->name }}</h3>
                    <p class="text-xs text-white/40">{{ $playlist->songs_count }} songs · {{ $playlist->user->name ?? 'Unknown' }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </section>
    @endif

    @if(!$userPlaylists->count() && !$publicPlaylists->count())
    <div class="text-center py-20">
        <svg class="w-20 h-20 mx-auto text-white/10 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2z"/></svg>
        <p class="text-white/40 text-lg mb-4">No playlists yet</p>
        <a href="{{ route('playlists.create') }}" class="btn-primary">Create your first playlist</a>
    </div>
    @endif
</div>
@endsection
