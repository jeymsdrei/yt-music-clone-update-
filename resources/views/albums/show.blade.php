@extends('layouts.app')

@section('title', $album->title)

@section('content')
<div class="space-y-10 fade-in">
    {{-- Album Header --}}
    <div class="flex flex-col md:flex-row gap-6 md:gap-10">
        <div class="relative flex-shrink-0 w-full md:w-72 aspect-square rounded-2xl overflow-hidden bg-white/5 shadow-2xl">
            @if($album->cover_url)
            <img src="{{ $album->cover_url }}" alt="{{ $album->title }}" class="w-full h-full object-cover">
            @else
            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-red-500/10 to-red-700/10">
                <svg class="w-24 h-24 text-white/10" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55C7.79 13 6 14.79 6 17s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/></svg>
            </div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
        </div>

        <div class="flex-1 flex flex-col justify-end">
            <span class="text-xs font-semibold uppercase tracking-widest text-red-500 mb-2">Album</span>
            <h1 class="text-3xl md:text-5xl font-bold mb-2">{{ $album->title }}</h1>
            <div class="flex items-center gap-2 text-sm text-white/60 mb-4">
                <a href="{{ route('artists.show', $album->artist) }}" class="hover:text-white transition-colors font-medium">
                    {{ $album->artist->name ?? 'Unknown Artist' }}
                </a>
                <span>&middot;</span>
                <span>{{ $album->release_year ?? 'N/A' }}</span>
                @if($album->songs && $album->songs->count())
                <span>&middot;</span>
                <span>{{ $album->songs->count() }} songs</span>
                @php
                    $totalSecs = $album->songs->sum('duration');
                    $mins = floor($totalSecs / 60);
                @endphp
                <span>&middot;</span>
                <span>{{ $mins }} min</span>
                @endif
            </div>
            <div class="flex items-center gap-3">
                <button class="btn-primary shadow-lg shadow-red-500/25" data-action="play-album" data-album="{{ $album->id }}">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    Play All
                </button>
                <button class="btn-ghost border border-white/10" data-action="shuffle-album" data-album="{{ $album->id }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    Shuffle
                </button>
                <button class="btn-ghost" data-action="like-album" data-album="{{ $album->id }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    Like
                </button>
            </div>
        </div>
    </div>

    {{-- Song List --}}
    @if($album->songs && $album->songs->count())
    <section>
        <div class="hidden md:grid grid-cols-[40px_1fr_1fr_80px_40px_40px] gap-4 px-4 py-2 text-xs font-medium text-white/30 uppercase tracking-wider border-b border-white/5">
            <span>#</span>
            <span>Title</span>
            <span>Artist</span>
            <span class="text-right">Duration</span>
            <span></span>
            <span></span>
        </div>
        <div class="space-y-1">
            @foreach($album->songs as $index => $song)
            <div class="grid grid-cols-[40px_1fr_1fr_80px_40px_40px] gap-4 items-center px-4 py-3 rounded-xl hover:bg-white/5 transition-colors group">
                <span class="text-sm text-white/30 group-hover:hidden">{{ $index + 1 }}</span>
                <button class="hidden group-hover:flex items-center justify-center w-6 h-6 text-white" data-action="play" data-song="{{ $song->id }}" title="Play">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                </button>
                <div class="min-w-0">
                    <h3 class="text-sm font-medium truncate">{{ $song->title }}</h3>
                </div>
                <div class="min-w-0">
                    <p class="text-sm text-white/40 truncate">{{ $song->artist->name ?? 'Unknown Artist' }}</p>
                </div>
                <span class="text-sm text-white/30 text-right tabular-nums">{{ gmdate('i:s', $song->duration) }}</span>
                <button class="p-1.5 rounded-full hover:bg-white/10 transition-colors text-white/30 hover:text-red-500" data-action="like" data-song="{{ $song->id }}" title="Like">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                </button>
                <button class="p-1.5 rounded-full hover:bg-white/10 transition-colors text-white/30 hover:text-white" data-action="queue" data-song="{{ $song->id }}" title="Add to Queue">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                </button>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    {{-- More by this Artist --}}
    @if(isset($album->artist->albums) && $album->artist->albums->where('id', '!=', $album->id)->count())
    <section>
        <h2 class="text-xl font-bold mb-4">More by {{ $album->artist->name }}</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($album->artist->albums->where('id', '!=', $album->id) as $relatedAlbum)
            <div class="music-card group">
                <div class="relative overflow-hidden rounded-xl aspect-square bg-white/5">
                    @if($relatedAlbum->cover_url)
                    <img src="{{ $relatedAlbum->cover_url }}" alt="{{ $relatedAlbum->title }}" class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-110" loading="lazy">
                    @else
                    <div class="flex items-center justify-center w-full h-full">
                        <svg class="w-12 h-12 text-white/20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55C7.79 13 6 14.79 6 17s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/></svg>
                    </div>
                    @endif
                </div>
                <div class="mt-2.5">
                    <h3 class="text-sm font-medium truncate">
                        <a href="{{ route('albums.show', $relatedAlbum) }}" class="hover:underline">{{ $relatedAlbum->title }}</a>
                    </h3>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif
</div>
@endsection
