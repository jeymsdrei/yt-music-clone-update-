@extends('layouts.app')

@section('title', $song->title)

@section('content')
<div class="space-y-8 fade-in">
    <div class="flex flex-col md:flex-row gap-8">
        <div class="flex-shrink-0 w-64 h-64 rounded-2xl overflow-hidden bg-white/5 mx-auto md:mx-0">
            @if($song->thumbnail_url)
            <img src="{{ $song->thumbnail_url }}" alt="{{ $song->title }}" class="w-full h-full object-cover">
            @else
            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-red-500/20 to-red-700/20">
                <svg class="w-20 h-20 text-white/20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55C7.79 13 6 14.79 6 17s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/></svg>
            </div>
            @endif
        </div>
        <div class="flex-1 min-w-0">
            <h1 class="text-3xl md:text-4xl font-bold">{{ $song->title }}</h1>
            <p class="text-lg text-white/60 mt-1">
                <a href="{{ route('artists.show', $song->artist) }}" class="hover:underline">{{ $song->artist->name ?? 'Unknown Artist' }}</a>
                @if($song->album)
                · <a href="{{ route('albums.show', $song->album) }}" class="hover:underline">{{ $song->album->title }}</a>
                @endif
            </p>
            <div class="flex items-center gap-4 mt-6">
                <button class="btn-primary shadow-lg shadow-red-500/25" data-action="play" data-song="{{ $song->id }}">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    Play
                </button>
                <button class="btn-ghost border border-white/10" data-action="like" data-song="{{ $song->id }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    Like
                </button>
            </div>
            <div class="flex items-center gap-6 mt-4 text-sm text-white/40">
                <span>{{ gmdate('i:s', $song->duration) }}</span>
                <span>{{ number_format($song->plays) }} plays</span>
                <span>{{ $song->genre }}</span>
            </div>
        </div>
    </div>

    @if($relatedSongs->count())
    <section>
        <h2 class="text-xl font-bold mb-4">More from {{ $song->artist->name ?? 'this artist' }}</h2>
        <div class="space-y-1">
            @foreach($relatedSongs as $related)
            <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-white/5 transition-colors group">
                <div class="flex-shrink-0 w-12 h-12 rounded-lg overflow-hidden bg-white/5">
                    @if($related->thumbnail_url)
                    <img src="{{ $related->thumbnail_url }}" alt="{{ $related->title }}" class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full flex items-center justify-center"><svg class="w-6 h-6 text-white/20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55C7.79 13 6 14.79 6 17s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/></svg></div>
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <h3 class="text-sm font-medium truncate">{{ $related->title }}</h3>
                    <p class="text-xs text-white/40 truncate">{{ $related->artist->name ?? 'Unknown Artist' }}</p>
                </div>
                <button class="p-2 rounded-full hover:bg-white/10 transition-colors opacity-0 group-hover:opacity-100" data-action="play" data-song="{{ $related->id }}">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                </button>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    <section>
        <h2 class="text-xl font-bold mb-4">Comments</h2>
        <div id="comments-section">
            @auth
            <form id="comment-form" data-song="{{ $song->id }}" class="flex gap-3 mb-6">
                @csrf
                <input type="text" name="body" placeholder="Add a comment..." class="input-field flex-1" required>
                <button type="submit" class="btn-primary">Post</button>
            </form>
            @endauth
            <div id="comments-list" class="space-y-4">
                @forelse($song->comments as $comment)
                <div class="flex gap-3">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-red-500 to-red-700 flex items-center justify-center text-xs font-bold flex-shrink-0">
                        {{ substr($comment->user->name ?? 'U', 0, 1) }}
                    </div>
                    <div>
                        <p class="text-sm"><strong>{{ $comment->user->name ?? 'Unknown' }}</strong> <span class="text-white/30 text-xs ml-2">{{ $comment->created_at->diffForHumans() }}</span></p>
                        <p class="text-sm text-white/70">{{ $comment->body }}</p>
                    </div>
                </div>
                @empty
                <p class="text-white/40 text-sm">No comments yet. Be the first to comment!</p>
                @endforelse
            </div>
        </div>
    </section>
</div>
@endsection
