@extends('layouts.app')

@section('title', 'Search')

@section('content')
<div class="space-y-8 fade-in">
    {{-- Search Header --}}
    <div>
        <h1 class="text-2xl font-bold">
            Results for "<span class="text-red-500">{{ $query }}</span>"
        </h1>
        <p class="text-white/40 text-sm mt-1">
            {{ ($songs->count() ?? 0) + ($albums->count() ?? 0) + ($artists->count() ?? 0) }} results found
        </p>
    </div>

    {{-- Filter Pills --}}
    @php $filter = request('filter', 'all'); @endphp
    <div class="flex flex-wrap gap-2">
        <a href="{{ route('search', array_merge(request()->except('filter'), ['q' => $query, 'filter' => 'all'])) }}" class="glass-card rounded-full px-4 py-2 text-sm font-medium hover:bg-red-500/10 hover:border-red-500/20 transition-all duration-200 {{ $filter === 'all' ? 'bg-red-500/10 border-red-500/20 text-red-500' : '' }}">
            All
        </a>
        <a href="{{ route('search', array_merge(request()->except('filter'), ['q' => $query, 'filter' => 'songs'])) }}" class="glass-card rounded-full px-4 py-2 text-sm font-medium hover:bg-red-500/10 hover:border-red-500/20 transition-all duration-200 {{ $filter === 'songs' ? 'bg-red-500/10 border-red-500/20 text-red-500' : '' }}">
            Songs
        </a>
        <a href="{{ route('search', array_merge(request()->except('filter'), ['q' => $query, 'filter' => 'albums'])) }}" class="glass-card rounded-full px-4 py-2 text-sm font-medium hover:bg-red-500/10 hover:border-red-500/20 transition-all duration-200 {{ $filter === 'albums' ? 'bg-red-500/10 border-red-500/20 text-red-500' : '' }}">
            Albums
        </a>
        <a href="{{ route('search', array_merge(request()->except('filter'), ['q' => $query, 'filter' => 'artists'])) }}" class="glass-card rounded-full px-4 py-2 text-sm font-medium hover:bg-red-500/10 hover:border-red-500/20 transition-all duration-200 {{ $filter === 'artists' ? 'bg-red-500/10 border-red-500/20 text-red-500' : '' }}">
            Artists
        </a>
    </div>

    {{-- Results --}}
    @php $hasResults = ($songs && $songs->count()) || ($albums && $albums->count()) || ($artists && $artists->count()); @endphp

    @if($hasResults)
        @if($filter === 'all' || $filter === 'songs')
            @if(isset($songs) && $songs->count())
            <section>
                <h2 class="text-lg font-semibold mb-4">Songs</h2>
                <div class="space-y-1">
                    @foreach($songs as $song)
                    <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-white/5 transition-colors group">
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
                            <p class="text-xs text-white/40 truncate">{{ $song->artist->name ?? 'Unknown Artist' }}</p>
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
        @endif

        @if($filter === 'all' || $filter === 'albums')
            @if(isset($albums) && $albums->count())
            <section>
                <h2 class="text-lg font-semibold mb-4">Albums</h2>
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
            </section>
            @endif
        @endif

        @if($filter === 'all' || $filter === 'artists')
            @if(isset($artists) && $artists->count())
            <section>
                <h2 class="text-lg font-semibold mb-4">Artists</h2>
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
            </section>
            @endif
        @endif
    @else
        {{-- No Results --}}
        <div class="text-center py-20">
            <svg class="w-20 h-20 mx-auto text-white/10 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <h2 class="text-xl font-semibold mb-2">No results found</h2>
            <p class="text-white/40">We couldn't find anything for "{{ $query }}". Try a different search term.</p>
        </div>
    @endif
</div>
@endsection
