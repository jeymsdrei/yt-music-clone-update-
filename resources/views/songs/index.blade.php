@extends('layouts.app')

@section('title', 'Browse Songs')

@section('content')
<div class="space-y-8 fade-in">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold">Browse Songs</h1>
            <p class="text-white/40 text-sm mt-1">Discover music across all genres</p>
        </div>
    </div>

    <div class="flex flex-wrap gap-2">
        <a href="{{ route('songs.index') }}" class="glass-card rounded-full px-4 py-2 text-sm font-medium hover:bg-red-500/10 transition-all {{ !request('category') ? 'bg-red-500/10 text-red-500 border-red-500/20' : '' }}">All</a>
        @foreach($categories as $category)
        <a href="{{ route('songs.index', ['category' => $category->id]) }}" class="glass-card rounded-full px-4 py-2 text-sm font-medium hover:bg-red-500/10 transition-all {{ request('category') == $category->id ? 'bg-red-500/10 text-red-500 border-red-500/20' : '' }}">{{ $category->name }}</a>
        @endforeach
    </div>

    <div class="space-y-1">
        @forelse($songs as $song)
        <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-white/5 transition-colors group" data-song-id="{{ $song->id }}">
            <div class="flex-shrink-0 w-12 h-12 rounded-lg overflow-hidden bg-white/5">
                @if($song->thumbnail_url)
                <img src="{{ $song->thumbnail_url }}" alt="{{ $song->title }}" class="w-full h-full object-cover">
                @else
                <div class="w-full h-full flex items-center justify-center"><svg class="w-6 h-6 text-white/20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55C7.79 13 6 14.79 6 17s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/></svg></div>
                @endif
            </div>
            <div class="flex-1 min-w-0">
                <h3 class="text-sm font-medium truncate">{{ $song->title }}</h3>
                <p class="text-xs text-white/40 truncate">{{ $song->artist->name ?? 'Unknown Artist' }} · {{ $song->album->title ?? 'Single' }}</p>
            </div>
            <span class="text-xs text-white/30 hidden md:block">{{ gmdate('i:s', $song->duration) }}</span>
            <span class="text-xs text-white/30 hidden md:block">{{ number_format($song->plays) }} plays</span>
            <button class="p-2 rounded-full hover:bg-white/10 transition-colors opacity-0 group-hover:opacity-100" data-action="play" data-song="{{ $song->id }}" title="Play">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
            </button>
        </div>
        @empty
        <div class="text-center py-16">
            <p class="text-white/40">No songs found.</p>
        </div>
        @endforelse
    </div>

    @if(method_exists($songs, 'links'))
    <div class="pt-4">{{ $songs->links() }}</div>
    @endif
</div>
@endsection
