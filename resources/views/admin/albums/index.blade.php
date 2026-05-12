@extends('layouts.admin')

@section('title', 'Albums')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold">Albums</h2>
            <p class="text-white/60 mt-1">Manage all albums on the platform</p>
        </div>
        <a href="{{ route('admin.albums.create') }}" class="btn-primary">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Create Album
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
        @forelse($albums as $album)
        <div class="glass-card rounded-xl overflow-hidden group">
            <div class="aspect-square overflow-hidden">
                @if($album->cover)
                <img src="{{ asset('storage/' . $album->cover) }}" alt="{{ $album->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                @else
                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-red-500/20 to-red-700/20">
                    <svg class="w-16 h-16 text-red-500/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2z"/>
                    </svg>
                </div>
                @endif
            </div>
            <div class="p-4">
                <h3 class="font-semibold truncate">{{ $album->title }}</h3>
                <p class="text-sm text-white/60 truncate">{{ $album->artist->name ?? 'Unknown Artist' }}</p>
                <div class="flex items-center justify-between mt-3 pt-3 border-t border-white/10">
                    <span class="text-xs text-white/40">{{ $album->songs_count ?? $album->songs->count() ?? 0 }} songs</span>
                    <div class="flex items-center gap-1">
                        <a href="{{ route('admin.albums.edit', $album) }}" class="p-1.5 rounded-lg hover:bg-white/10 text-white/60 hover:text-white transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </a>
                        <form method="POST" action="{{ route('admin.albums.destroy', $album) }}" onsubmit="return confirm('Are you sure you want to delete this album?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-1.5 rounded-lg hover:bg-red-500/20 text-white/60 hover:text-red-400 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-16">
            <svg class="w-16 h-16 mx-auto text-white/20 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2z"/>
            </svg>
            <p class="text-white/40">No albums found</p>
            <a href="{{ route('admin.albums.create') }}" class="btn-primary mt-4 inline-flex">Create your first album</a>
        </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $albums->links() }}
    </div>
</div>
@endsection
