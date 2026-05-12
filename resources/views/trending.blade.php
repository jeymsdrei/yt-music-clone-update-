@extends('layouts.app')

@section('title', 'Trending')

@section('content')
<div class="space-y-10 fade-in">
    {{-- Hero #1 Trending --}}
    @if(isset($trendingSongs) && $trendingSongs->count())
    @php $topSong = $trendingSongs->first(); @endphp
    <section class="relative rounded-2xl overflow-hidden h-[300px] md:h-[400px] group">
        <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a0a] via-[#0a0a0a]/40 to-transparent z-10"></div>
        <div class="absolute top-4 left-4 z-20">
            <span class="flex items-center gap-2 px-3 py-1.5 rounded-full glass text-xs font-semibold">
                <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 24 24"><path d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                #1 Trending
            </span>
        </div>
        @if($topSong->thumbnail_url)
        <img src="{{ $topSong->thumbnail_url }}" alt="{{ $topSong->title }}" class="w-full h-full object-cover">
        @else
        <div class="w-full h-full bg-gradient-to-br from-red-900/30 to-[#1a1a1a] flex items-center justify-center">
            <svg class="w-32 h-32 text-white/5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55C7.79 13 6 14.79 6 17s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/></svg>
        </div>
        @endif
        <div class="absolute bottom-0 left-0 right-0 z-20 p-6 md:p-10">
            <h2 class="text-2xl md:text-4xl font-bold mb-1">{{ $topSong->title }}</h2>
            <p class="text-white/60 text-sm md:text-base mb-4">{{ $topSong->artist->name ?? 'Unknown Artist' }}</p>
            <div class="flex items-center gap-3">
                <button class="btn-primary shadow-lg shadow-red-500/25" data-action="play" data-song="{{ $topSong->id }}">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    Play Now
                </button>
                <button class="btn-ghost border border-white/10" data-action="like" data-song="{{ $topSong->id }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                </button>
            </div>
        </div>
    </section>

    {{-- Top 50 List --}}
    <section>
        <h2 class="text-xl md:text-2xl font-bold mb-6">Top 50</h2>
        <div class="space-y-1">
            @foreach($trendingSongs as $index => $song)
            <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-white/5 transition-colors group">
                <span class="w-8 text-center text-lg font-bold {{ $index < 3 ? 'text-red-500' : 'text-white/30' }}">{{ $index + 1 }}</span>
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
                <div class="hidden md:flex items-center gap-4 text-xs text-white/30">
                    @if(isset($song->play_count))
                    <span class="flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ number_format($song->play_count) }}
                    </span>
                    @endif
                    @if(isset($song->duration))
                    <span>{{ gmdate('i:s', $song->duration) }}</span>
                    @endif
                </div>
                <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                    <button class="p-2 rounded-full hover:bg-white/10 transition-colors" data-action="play" data-song="{{ $song->id }}" title="Play">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    </button>
                    <button class="p-2 rounded-full hover:bg-white/10 transition-colors" data-action="like" data-song="{{ $song->id }}" title="Like">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @else
    <div class="text-center py-20">
        <svg class="w-20 h-20 mx-auto text-white/10 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
        </svg>
        <p class="text-white/40 text-lg">No trending songs available right now.</p>
    </div>
    @endif

    {{-- Pagination --}}
    @if(isset($trendingSongs) && method_exists($trendingSongs, 'links'))
    <div class="pt-4">
        {{ $trendingSongs->links() }}
    </div>
    @endif
</div>
@endsection
