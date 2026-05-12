@extends('layouts.app')

@section('title', $playlist->name)

@section('content')
<div class="space-y-10 fade-in">
    {{-- Playlist Header --}}
    <div class="flex flex-col md:flex-row gap-6 md:gap-10">
        <div class="relative flex-shrink-0 w-full md:w-72 aspect-square rounded-2xl overflow-hidden bg-white/5 shadow-2xl">
            @if($playlist->cover_image)
            <img src="{{ asset('storage/' . $playlist->cover_image) }}" alt="{{ $playlist->name }}" class="w-full h-full object-cover">
            @else
            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-red-500/10 via-red-600/10 to-purple-500/10">
                <svg class="w-24 h-24 text-white/10" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55C7.79 13 6 14.79 6 17s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/></svg>
            </div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
        </div>

        <div class="flex-1 flex flex-col justify-end">
            <span class="text-xs font-semibold uppercase tracking-widest text-red-500 mb-2">Playlist</span>
            <h1 class="text-3xl md:text-5xl font-bold mb-2">{{ $playlist->name }}</h1>
            @if($playlist->description)
            <p class="text-white/40 text-sm mb-3">{{ $playlist->description }}</p>
            @endif
            <div class="flex items-center gap-2 text-sm text-white/60 mb-4">
                <span class="font-medium text-white">{{ $playlist->user->name ?? 'Unknown' }}</span>
                <span>&middot;</span>
                <span>{{ $playlist->songs_count ?? $playlist->songs->count() ?? 0 }} songs</span>
            </div>
            <div class="flex items-center gap-3">
                <button class="btn-primary shadow-lg shadow-red-500/25" data-action="play-playlist" data-playlist="{{ $playlist->id }}">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    Play All
                </button>
                <button class="btn-ghost border border-white/10" data-action="shuffle-playlist" data-playlist="{{ $playlist->id }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    Shuffle
                </button>
                @auth
                    @if(Auth::user()->id === $playlist->user_id)
                    <a href="{{ route('playlists.edit', $playlist) }}" class="btn-ghost">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Edit
                    </a>
                    <form method="POST" action="{{ route('playlists.destroy', $playlist) }}" class="inline" onsubmit="return confirm('Delete this playlist?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-ghost text-red-400 hover:text-red-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            Delete
                        </button>
                    </form>
                    @endif
                @endauth
            </div>
        </div>
    </div>

    {{-- Song List --}}
    @if($playlist->songs && $playlist->songs->count())
    <section>
        <div class="hidden md:grid grid-cols-[40px_48px_1fr_1fr_1fr_80px_40px_40px] gap-4 px-4 py-2 text-xs font-medium text-white/30 uppercase tracking-wider border-b border-white/5">
            <span>#</span>
            <span></span>
            <span>Title</span>
            <span>Artist</span>
            <span>Album</span>
            <span class="text-right">Duration</span>
            <span></span>
            <span></span>
        </div>
        <div class="space-y-1">
            @foreach($playlist->songs as $index => $song)
            <div class="grid grid-cols-[40px_48px_1fr_1fr_1fr_80px_40px_40px] gap-4 items-center px-4 py-3 rounded-xl hover:bg-white/5 transition-colors group">
                <span class="text-sm text-white/30 group-hover:hidden">{{ $index + 1 }}</span>
                <button class="hidden group-hover:flex items-center justify-center w-6 h-6 text-white" data-action="play" data-song="{{ $song->id }}" title="Play">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                </button>
                <div class="flex-shrink-0 w-12 h-12 rounded-lg overflow-hidden bg-white/5">
                    @if($song->thumbnail_url)
                    <img src="{{ $song->thumbnail_url }}" alt="{{ $song->title }}" class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-white/20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55C7.79 13 6 14.79 6 17s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/></svg>
                    </div>
                    @endif
                </div>
                <div class="min-w-0">
                    <h3 class="text-sm font-medium truncate">{{ $song->title }}</h3>
                </div>
                <div class="min-w-0 hidden md:block">
                    <p class="text-sm text-white/40 truncate">{{ $song->artist->name ?? 'Unknown Artist' }}</p>
                </div>
                <div class="min-w-0 hidden lg:block">
                    <p class="text-sm text-white/40 truncate">{{ $song->album->title ?? '-' }}</p>
                </div>
                <span class="text-sm text-white/30 text-right tabular-nums">{{ gmdate('i:s', $song->duration) }}</span>
                <button class="p-1.5 rounded-full hover:bg-white/10 transition-colors text-white/30 hover:text-red-500" data-action="like" data-song="{{ $song->id }}" title="Like">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                </button>
                @auth
                    @if(Auth::user()->id === $playlist->user_id)
                    <form method="POST" action="{{ route('playlists.remove-song', [$playlist, $song]) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-1.5 rounded-full hover:bg-white/10 transition-colors text-white/30 hover:text-red-400" title="Remove">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </form>
                    @endif
                @endauth
            </div>
            @endforeach
        </div>
    </section>
    @else
    <div class="text-center py-20">
        <svg class="w-16 h-16 mx-auto text-white/10 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2z"/>
        </svg>
        <p class="text-white/40 text-lg mb-4">This playlist is empty</p>
        @auth
            @if(Auth::user()->id === $playlist->user_id)
            <button class="btn-primary" id="add-songs-btn">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add Songs
            </button>
            @endif
        @endauth
    </div>
    @endif

    {{-- Add Songs Button (if owner) --}}
    @auth
        @if(Auth::user()->id === $playlist->user_id && $playlist->songs && $playlist->songs->count())
        <div class="flex justify-center">
            <button class="btn-ghost border border-white/10 border-dashed" id="add-songs-btn">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add Songs
            </button>
        </div>
        @endif
    @endauth
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addBtn = document.getElementById('add-songs-btn');
        if (addBtn) {
            addBtn.addEventListener('click', function() {
                alert('Song search modal would open here. This requires Livewire or Alpine.js integration.');
            });
        }
    });
</script>
@endpush
