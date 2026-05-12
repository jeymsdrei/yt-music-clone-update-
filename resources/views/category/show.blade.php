@extends('layouts.app')

@section('title', $category->name)

@section('content')
<div class="space-y-8 fade-in">
    {{-- Category Header --}}
    <div class="relative rounded-2xl overflow-hidden h-48 md:h-64">
        <div class="absolute inset-0 bg-gradient-to-br from-red-900/40 via-red-800/10 to-[#1a1a1a]"></div>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_left,_var(--tw-gradient-stops))] from-red-500/10 via-transparent to-transparent"></div>
        <div class="absolute bottom-0 left-0 right-0 p-6 md:p-10">
            <span class="text-xs font-semibold uppercase tracking-widest text-red-500 mb-2 block">Category</span>
            <h1 class="text-3xl md:text-5xl font-bold">{{ $category->name }}</h1>
            @if(isset($songs))
            <p class="text-white/40 text-sm mt-2">{{ $songs->total() ?? $songs->count() }} songs</p>
            @endif
        </div>
    </div>

    {{-- Filters --}}
    @php $filter = request('filter', 'all'); @endphp
    <div class="flex items-center gap-2 border-b border-white/5">
        <a href="{{ route('categories.show', array_merge(['category' => $category], request()->except('filter'))) }}" class="nav-link {{ $filter === 'all' ? 'active' : '' }}">All</a>
        <a href="{{ route('categories.show', array_merge(['category' => $category, 'filter' => 'recent'])) }}" class="nav-link {{ $filter === 'recent' ? 'active' : '' }}">Recent</a>
        <a href="{{ route('categories.show', array_merge(['category' => $category, 'filter' => 'popular'])) }}" class="nav-link {{ $filter === 'popular' ? 'active' : '' }}">Popular</a>
    </div>

    {{-- Song List --}}
    @if(isset($songs) && $songs->count())
    <div class="space-y-1">
        @foreach($songs as $index => $song)
        <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-white/5 transition-colors group">
            <span class="w-6 text-center text-sm text-white/30 font-medium">{{ $songs->firstItem() + $index }}</span>
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
            <button class="p-2 rounded-full hover:bg-white/10 transition-colors opacity-0 group-hover:opacity-100 text-white/30 hover:text-red-500" data-action="like" data-song="{{ $song->id }}" title="Like">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
            </button>
        </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="pt-4">
        {{ $songs->links() }}
    </div>
    @else
    <div class="text-center py-20">
        <svg class="w-16 h-16 mx-auto text-white/10 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2z"/>
        </svg>
        <p class="text-white/40 text-lg">No songs found in this category.</p>
    </div>
    @endif
</div>
@endsection
