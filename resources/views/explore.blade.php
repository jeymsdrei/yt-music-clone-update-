@extends('layouts.app')

@section('title', 'Explore')

@section('content')
<div class="space-y-8 fade-in">
    {{-- Search --}}
    <div class="max-w-2xl mx-auto w-full">
        <form action="{{ route('search') }}" method="GET" class="relative">
            <svg class="absolute left-5 top-1/2 -translate-y-1/2 w-6 h-6 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="search" name="q" placeholder="Search songs, artists, albums..." class="input-field pl-14 py-4 text-lg rounded-2xl border border-white/10 focus:border-red-500/50">
        </form>
    </div>

    {{-- Categories --}}
    @if(isset($categories) && $categories->count())
    <div class="flex flex-wrap justify-center gap-2">
        <a href="{{ route('explore') }}" class="glass-card rounded-full px-4 py-2 text-sm font-medium hover:bg-red-500/10 hover:border-red-500/20 transition-all duration-200 {{ !request('category') ? 'bg-red-500/10 border-red-500/20 text-red-500' : '' }}">
            All
        </a>
        @foreach($categories as $category)
        <a href="{{ route('explore', ['category' => $category->id]) }}" class="glass-card rounded-full px-4 py-2 text-sm font-medium hover:bg-red-500/10 hover:border-red-500/20 transition-all duration-200 {{ request('category') == $category->id ? 'bg-red-500/10 border-red-500/20 text-red-500' : '' }}">
            {{ $category->name }}
        </a>
        @endforeach
    </div>
    @endif

    {{-- Tabs --}}
    @php $tab = request('tab', 'all'); @endphp
    <div class="flex items-center gap-1 border-b border-white/5">
        <a href="{{ route('explore', array_merge(request()->except('tab'), ['tab' => 'all'])) }}" class="nav-link {{ $tab === 'all' ? 'active' : '' }}">All</a>
        <a href="{{ route('explore', array_merge(request()->except('tab'), ['tab' => 'songs'])) }}" class="nav-link {{ $tab === 'songs' ? 'active' : '' }}">Songs</a>
        <a href="{{ route('explore', array_merge(request()->except('tab'), ['tab' => 'albums'])) }}" class="nav-link {{ $tab === 'albums' ? 'active' : '' }}">Albums</a>
        <a href="{{ route('explore', array_merge(request()->except('tab'), ['tab' => 'artists'])) }}" class="nav-link {{ $tab === 'artists' ? 'active' : '' }}">Artists</a>
    </div>

    {{-- Results --}}
    <div class="tab-content">
        @if($tab === 'all' || $tab === 'songs')
            @if(isset($songs) && $songs->count())
            <section class="mb-10">
                <h3 class="text-lg font-semibold mb-4">Songs</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach($songs as $song)
                        @include('partials.song-card', ['song' => $song])
                    @endforeach
                </div>
            </section>
            @endif
        @endif

        @if($tab === 'all' || $tab === 'albums')
            @if(isset($albums) && $albums->count())
            <section class="mb-10">
                <h3 class="text-lg font-semibold mb-4">Albums</h3>
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
                            <p class="text-xs truncate text-white/40">{{ $album->artist->name ?? 'Various Artists' }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
            @endif
        @endif

        @if($tab === 'all' || $tab === 'artists')
            @if(isset($artists) && $artists->count())
            <section class="mb-10">
                <h3 class="text-lg font-semibold mb-4">Artists</h3>
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

        @if(!isset($songs) || (!$songs->count() && !isset($albums) || !$albums->count() && !isset($artists) || !$artists->count()))
        <div class="text-center py-16">
            <svg class="w-16 h-16 mx-auto text-white/10 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <p class="text-white/40 text-lg">No results found. Try a different category or search term.</p>
        </div>
        @endif
    </div>

    {{-- Pagination --}}
    @if(isset($songs) && method_exists($songs, 'links'))
    <div class="pt-4">
        {{ $songs->links() }}
    </div>
    @endif
</div>
@endsection
