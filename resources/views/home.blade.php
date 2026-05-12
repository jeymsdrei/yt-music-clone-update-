@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="space-y-10 fade-in">
    {{-- Hero Carousel --}}
    @if(isset($featuredSongs) && $featuredSongs->count())
    <section class="relative rounded-2xl overflow-hidden h-[320px] md:h-[420px] group">
        <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a0a] via-[#0a0a0a]/30 to-transparent z-10"></div>
        <div class="flex h-full transition-transform duration-500" id="featured-carousel">
            @foreach($featuredSongs as $index => $song)
            <div class="min-w-full h-full relative {{ $index === 0 ? '' : 'hidden' }}" data-slide="{{ $index }}">
                @if($song->thumbnail_url)
                <img src="{{ $song->thumbnail_url }}" alt="{{ $song->title }}" class="w-full h-full object-cover">
                @else
                <div class="w-full h-full bg-gradient-to-br from-red-900/40 to-[#1a1a1a] flex items-center justify-center">
                    <svg class="w-24 h-24 text-white/10" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55C7.79 13 6 14.79 6 17s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/></svg>
                </div>
                @endif
                <div class="absolute bottom-0 left-0 right-0 z-20 p-6 md:p-10">
                    <span class="text-xs font-semibold uppercase tracking-widest text-red-500 mb-2 block">Featured</span>
                    <h2 class="text-2xl md:text-4xl font-bold mb-1">{{ $song->title }}</h2>
                    <p class="text-white/60 text-sm md:text-base mb-4">{{ $song->artist->name ?? 'Unknown Artist' }}</p>
                    <div class="flex items-center gap-3">
                        <button class="btn-primary shadow-lg shadow-red-500/25" data-action="play" data-song="{{ $song->id }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                            Play Now
                        </button>
                        <button class="btn-ghost border border-white/10" data-action="like" data-song="{{ $song->id }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                            Like
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @if($featuredSongs->count() > 1)
        <div class="absolute bottom-4 right-4 z-20 flex gap-2">
            @foreach($featuredSongs as $index => $song)
            <button class="w-2 h-2 rounded-full bg-white/30 hover:bg-white/60 transition-colors" data-dot="{{ $index }}"></button>
            @endforeach
        </div>
        @endif
    </section>
    @endif

    {{-- Recently Played --}}
    @if(isset($recentSongs) && $recentSongs->count())
    <section>
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl md:text-2xl font-bold">Recently Played</h2>
            <a href="{{ route('recently-played') }}" class="text-sm text-white/40 hover:text-white transition-colors">See all</a>
        </div>
        <div class="flex gap-4 overflow-x-auto pb-2 scrollbar-none snap-x">
            @foreach($recentSongs as $song)
                <div class="flex-shrink-0 w-40 snap-start">
                    @include('partials.song-card', ['song' => $song])
                </div>
            @endforeach
        </div>
    </section>
    @endif

    {{-- Trending Now --}}
    @if(isset($trendingSongs) && $trendingSongs->count())
    <section>
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl md:text-2xl font-bold">Trending Now</h2>
            <a href="{{ route('trending') }}" class="text-sm text-white/40 hover:text-white transition-colors">See all</a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($trendingSongs as $song)
                @include('partials.song-card', ['song' => $song])
            @endforeach
        </div>
    </section>
    @endif

    {{-- Recommended for You --}}
    @if(isset($recommendedSongs) && $recommendedSongs->count())
    <section>
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl md:text-2xl font-bold">Recommended for You</h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($recommendedSongs as $song)
                @include('partials.song-card', ['song' => $song])
            @endforeach
        </div>
    </section>
    @endif

    {{-- Top Artists --}}
    @if(isset($artists) && $artists->count())
    <section>
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl md:text-2xl font-bold">Top Artists</h2>
            <a href="{{ route('explore') }}" class="text-sm text-white/40 hover:text-white transition-colors">See all</a>
        </div>
        <div class="flex gap-6 overflow-x-auto pb-2 scrollbar-none snap-x">
            @foreach($artists as $artist)
            <a href="{{ route('artists.show', $artist) }}" class="flex-shrink-0 w-28 snap-start group text-center">
                <div class="w-28 h-28 rounded-full overflow-hidden bg-white/5 mb-3 ring-2 ring-transparent group-hover:ring-red-500/50 transition-all">
                    @if($artist->image_url)
                    <img src="{{ $artist->image_url }}" alt="{{ $artist->name }}" class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-red-500/20 to-red-700/20">
                        <span class="text-2xl font-bold text-white/30">{{ substr($artist->name, 0, 1) }}</span>
                    </div>
                    @endif
                </div>
                <h3 class="text-sm font-medium truncate">{{ $artist->name }}</h3>
                <p class="text-xs text-white/40 truncate">Artist</p>
            </a>
            @endforeach
        </div>
    </section>
    @endif

    {{-- New Releases --}}
    @if(isset($newAlbums) && $newAlbums->count())
    <section>
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl md:text-2xl font-bold">New Releases</h2>
            <a href="{{ route('explore') }}" class="text-sm text-white/40 hover:text-white transition-colors">See all</a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($newAlbums as $album)
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

    {{-- Categories --}}
    @if(isset($categories) && $categories->count())
    <section>
        <h2 class="text-xl md:text-2xl font-bold mb-4">Browse by Category</h2>
        <div class="flex flex-wrap gap-3">
            @foreach($categories as $category)
            <a href="{{ route('categories.show', $category) }}" class="glass-card rounded-full px-5 py-2.5 text-sm font-medium hover:bg-red-500/10 hover:border-red-500/20 transition-all duration-200">
                <span>{{ $category->name }}</span>
            </a>
            @endforeach
        </div>
    </section>
    @endif
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const carousel = document.getElementById('featured-carousel');
        if (!carousel) return;
        const slides = carousel.querySelectorAll('[data-slide]');
        const dots = document.querySelectorAll('[data-dot]');
        if (!slides.length) return;
        let current = 0;
        function showSlide(index) {
            slides.forEach((s, i) => {
                s.classList.toggle('hidden', i !== index);
            });
            dots.forEach((d, i) => {
                d.style.background = i === index ? 'rgba(255,255,255,0.8)' : 'rgba(255,255,255,0.3)';
            });
        }
        dots.forEach((dot, i) => {
            dot.addEventListener('click', () => { current = i; showSlide(current); });
        });
        setInterval(() => {
            current = (current + 1) % slides.length;
            showSlide(current);
        }, 5000);
    });
</script>
@endpush
