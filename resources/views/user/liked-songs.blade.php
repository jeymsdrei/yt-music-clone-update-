@extends('layouts.app')

@section('title', 'Liked Songs')

@section('content')
<div class="space-y-8 fade-in">
    <div>
        <h1 class="text-2xl md:text-3xl font-bold">Liked Songs</h1>
        <p class="text-white/40 text-sm mt-1">All your favorite tracks in one place</p>
    </div>

    @if($songs->count())
    <div class="space-y-1">
        @foreach($songs as $like)
        @php $song = $like->song; @endphp
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
            <button class="p-2 rounded-full hover:bg-white/10 text-red-500 transition-colors" data-action="unlike" data-song="{{ $like->song_id }}">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
            </button>
        </div>
        @endforeach
    </div>
    <div class="pt-4">{{ $songs->links() }}</div>
    @else
    <div class="text-center py-20">
        <svg class="w-20 h-20 mx-auto text-white/10 mb-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
        <p class="text-white/40 text-lg">No liked songs yet.</p>
        <p class="text-white/20 text-sm mt-1">Tap the heart icon on any song to add it here.</p>
    </div>
    @endif
</div>
@endsection
