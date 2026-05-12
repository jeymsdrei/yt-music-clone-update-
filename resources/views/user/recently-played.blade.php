@extends('layouts.app')

@section('title', 'Recently Played')

@section('content')
<div class="space-y-8 fade-in">
    <div>
        <h1 class="text-2xl md:text-3xl font-bold">Recently Played</h1>
        <p class="text-white/40 text-sm mt-1">Your listening history</p>
    </div>

    @if($recentlyPlayed->count())
    <div class="space-y-1">
        @foreach($recentlyPlayed as $item)
        @php $song = $item->song; @endphp
        <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-white/5 transition-colors group">
            <div class="flex-shrink-0 w-12 h-12 rounded-lg overflow-hidden bg-white/5">
                @if($song && $song->thumbnail_url)
                <img src="{{ $song->thumbnail_url }}" alt="{{ $song->title }}" class="w-full h-full object-cover">
                @else
                <div class="w-full h-full flex items-center justify-center"><svg class="w-6 h-6 text-white/20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55C7.79 13 6 14.79 6 17s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/></svg></div>
                @endif
            </div>
            <div class="flex-1 min-w-0">
                <h3 class="text-sm font-medium truncate">{{ $song->title ?? 'Unknown' }}</h3>
                <p class="text-xs text-white/40 truncate">{{ $song->artist->name ?? 'Unknown Artist' }}</p>
            </div>
            <span class="text-xs text-white/30">{{ $item->played_at->diffForHumans() }}</span>
            <button class="p-2 rounded-full hover:bg-white/10 transition-colors opacity-0 group-hover:opacity-100" data-action="play" data-song="{{ $song->id ?? '' }}">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
            </button>
        </div>
        @endforeach
    </div>
    <div class="pt-4">{{ $recentlyPlayed->links() }}</div>
    @else
    <div class="text-center py-20">
        <svg class="w-20 h-20 mx-auto text-white/10 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <p class="text-white/40 text-lg">No recently played songs.</p>
        <p class="text-white/20 text-sm mt-1">Start listening to build your history.</p>
    </div>
    @endif
</div>
@endsection
