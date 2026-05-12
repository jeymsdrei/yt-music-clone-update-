@extends('layouts.app')

@section('title', $artist->name)

@section('content')
<div class="space-y-10 fade-in">
    {{-- Artist Header --}}
    <div class="relative rounded-2xl overflow-hidden">
        <div class="h-48 md:h-72 bg-gradient-to-r from-red-900/40 via-red-800/10 to-[#1a1a1a]"></div>
        <div class="absolute bottom-0 left-0 right-0 p-6 md:p-10 flex flex-col md:flex-row md:items-end gap-4 md:gap-8">
            <div class="w-32 h-32 md:w-48 md:h-48 rounded-full overflow-hidden ring-4 ring-[#0a0a0a] -mt-16 md:-mt-24 flex-shrink-0 shadow-2xl">
                @if($artist->image_url)
                <img src="{{ $artist->image_url }}" alt="{{ $artist->name }}" class="w-full h-full object-cover">
                @else
                <div class="w-full h-full bg-gradient-to-br from-red-500 to-red-700 flex items-center justify-center">
                    <span class="text-4xl md:text-6xl font-bold text-white/50">{{ substr($artist->name, 0, 1) }}</span>
                </div>
                @endif
            </div>
            <div class="flex-1 min-w-0">
                <div class="flex items-center gap-2 mb-1">
                    <h1 class="text-3xl md:text-5xl font-bold">{{ $artist->name }}</h1>
                    <svg class="w-6 h-6 text-blue-500 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2m-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                </div>
                @if($artist->genre)
                <p class="text-white/40 text-sm mb-4">{{ $artist->genre }}</p>
                @endif
                <div class="flex items-center gap-3">
                    <button class="btn-primary shadow-lg shadow-red-500/25" data-action="follow-artist" data-artist="{{ $artist->id }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                        Follow
                    </button>
                    <button class="btn-ghost border border-white/10" data-action="play-artist" data-artist="{{ $artist->id }}">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        Play All
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Popular Songs --}}
    @if(isset($artist->songs) && $artist->songs->count())
    <section>
        <h2 class="text-xl md:text-2xl font-bold mb-4">Popular Songs</h2>
        <div class="space-y-1">
            @php $popularSongs = $artist->songs->sortByDesc('play_count')->take(5); @endphp
            @foreach($popularSongs as $index => $song)
            <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-white/5 transition-colors group">
                <span class="w-6 text-center text-sm font-bold text-white/30">{{ $index + 1 }}</span>
                <div class="flex-shrink-0 w-12 h-12 rounded-lg overflow-hidden bg-white/5">
                    @if($song->thumbnail_url)
                    <img src="{{ $song->thumbnail_url }}" alt="{{ $song->title }}" class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-white/20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55C7.79 13 6 14.79 6 17s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/></svg>
                    </div>
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <h3 class="text-sm font-medium truncate">{{ $song->title }}</h3>
                    <p class="text-xs text-white/40 truncate">{{ number_format($song->play_count ?? 0) }} plays</p>
                </div>
                @if(isset($song->duration))
                <span class="text-xs text-white/30">{{ gmdate('i:s', $song->duration) }}</span>
                @endif
                <button class="p-2 rounded-full hover:bg-white/10 transition-colors opacity-0 group-hover:opacity-100" data-action="play" data-song="{{ $song->id }}" title="Play">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                </button>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    {{-- Albums --}}
    @if(isset($artist->albums) && $artist->albums->count())
    <section>
        <h2 class="text-xl md:text-2xl font-bold mb-4">Albums</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($artist->albums as $album)
            <div class="music-card group">
                <div class="relative overflow-hidden rounded-xl aspect-square bg-white/5">
                    @if($album->cover_url)
                    <img src="{{ $album->cover_url }}" alt="{{ $album->title }}" class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-110" loading="lazy">
                    @else
                    <div class="flex items-center justify-center w-full h-full">
                        <svg class="w-12 h-12 text-white/20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55C7.79 13 6 14.79 6 17s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/></svg>
                    </div>
                    @endif
                    <div class="absolute inset-0 flex items-center justify-center transition-all duration-300 opacity-0 bg-black/30 group-hover:opacity-100">
                        <button class="flex items-center justify-center w-12 h-12 transition-transform rounded-full bg-red-500 hover:bg-red-400 hover:scale-110 shadow-lg shadow-red-500/25" data-action="play-album" data-album="{{ $album->id }}">
                            <svg class="w-6 h-6 text-white ml-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </button>
                    </div>
                </div>
                <div class="mt-2.5">
                    <h3 class="text-sm font-medium truncate">
                        <a href="{{ route('albums.show', $album) }}" class="hover:underline">{{ $album->title }}</a>
                    </h3>
                    <p class="text-xs text-white/40">{{ $album->release_year ?? '' }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    {{-- Similar Artists --}}
    @if(isset($similarArtists) && $similarArtists->count())
    <section>
        <h2 class="text-xl md:text-2xl font-bold mb-4">Similar Artists</h2>
        <div class="flex gap-6 overflow-x-auto pb-2 scrollbar-none snap-x">
            @foreach($similarArtists as $similar)
            <a href="{{ route('artists.show', $similar) }}" class="flex-shrink-0 w-28 snap-start group text-center">
                <div class="w-28 h-28 rounded-full overflow-hidden bg-white/5 mb-3 ring-2 ring-transparent group-hover:ring-red-500/50 transition-all">
                    @if($similar->image_url)
                    <img src="{{ $similar->image_url }}" alt="{{ $similar->name }}" class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-red-500/20 to-red-700/20">
                        <span class="text-2xl font-bold text-white/30">{{ substr($similar->name, 0, 1) }}</span>
                    </div>
                    @endif
                </div>
                <h3 class="text-sm font-medium truncate">{{ $similar->name }}</h3>
            </a>
            @endforeach
        </div>
    </section>
    @endif
</div>
@endsection
