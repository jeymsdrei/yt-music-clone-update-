<div class="music-card group" data-song="{{ $song->id ?? '' }}" data-url="{{ $song->audio_url ?? '' }}" data-title="{{ $song->title ?? '' }}" data-artist="{{ $song->artist->name ?? 'Unknown Artist' }}" data-thumbnail="{{ $song->thumbnail_url ?? '' }}">
    <div class="relative overflow-hidden rounded-xl aspect-square bg-white/5">
        @if(isset($song->thumbnail_url))
            <img src="{{ $song->thumbnail_url }}" alt="{{ $song->title }}" class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-110" loading="lazy">
        @else
            <div class="flex items-center justify-center w-full h-full">
                <svg class="w-12 h-12 text-white/20" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55C7.79 13 6 14.79 6 17s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/>
                </svg>
            </div>
        @endif

        @if(isset($song->duration))
            <span class="absolute px-2 py-0.5 text-xs font-medium rounded-md bottom-2 right-2 bg-black/60 backdrop-blur-sm text-white/90">
                {{ gmdate('i:s', $song->duration) }}
            </span>
        @endif

        <div class="absolute inset-0 flex items-center justify-center transition-all duration-300 opacity-0 bg-black/30 group-hover:opacity-100">
            <button class="flex items-center justify-center w-12 h-12 transition-transform rounded-full bg-red-500 hover:bg-red-400 hover:scale-110 shadow-lg shadow-red-500/25" data-action="play" title="Play">
                <svg class="w-6 h-6 text-white ml-0.5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M8 5v14l11-7z"/>
                </svg>
            </button>
        </div>

        <button class="absolute top-2 right-2 p-1.5 rounded-full bg-black/40 backdrop-blur-sm text-white/60 hover:text-red-500 opacity-0 group-hover:opacity-100 transition-all" data-action="like" title="Like">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>
        </button>
    </div>

    <div class="mt-2.5">
        <h3 class="text-sm font-medium truncate text-white group-hover:text-white transition-colors">
            <a href="{{ route('songs.show', $song) ?? '#' }}" class="hover:underline">
                {{ $song->title ?? 'Untitled' }}
            </a>
        </h3>
        <p class="text-xs truncate text-white/40 mt-0.5">
            <a href="{{ route('artists.show', $song->artist) ?? '#' }}" class="hover:text-white/60 transition-colors">
                {{ $song->artist->name ?? 'Unknown Artist' }}
            </a>
        </p>
    </div>
</div>
