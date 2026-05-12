@extends('layouts.admin')

@section('title', 'Artists')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold">Artists</h2>
            <p class="text-white/60 mt-1">Manage all artists on the platform</p>
        </div>
        <a href="{{ route('admin.artists.create') }}" class="btn-primary">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Create Artist
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
        @forelse($artists as $artist)
        <div class="glass-card rounded-xl overflow-hidden group">
            <div class="aspect-square overflow-hidden">
                @if($artist->image)
                <img src="{{ asset('storage/' . $artist->image) }}" alt="{{ $artist->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                @else
                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-red-500/20 to-red-700/20">
                    <svg class="w-16 h-16 text-red-500/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                @endif
            </div>
            <div class="p-4">
                <div class="flex items-center gap-2">
                    <h3 class="font-semibold truncate">{{ $artist->name }}</h3>
                    @if($artist->verified)
                    <svg class="w-4 h-4 text-red-500 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M23 12l-2.44-2.78.34-3.68-3.61-.82-1.89-3.18L12 3 8.6 1.54 6.71 4.72l-3.61.81.34 3.68L1 12l2.44 2.78-.34 3.69 3.61.82 1.89 3.18L12 21l3.4 1.46 1.89-3.18 3.61-.82-.34-3.68L23 12z"/>
                    </svg>
                    @endif
                </div>
                <p class="text-sm text-white/60 truncate">{{ $artist->genre ?? 'Various' }}</p>
                <div class="flex items-center justify-between mt-3 pt-3 border-t border-white/10">
                    <div class="flex gap-3 text-xs text-white/40">
                        <span>{{ $artist->songs_count ?? $artist->songs->count() ?? 0 }} songs</span>
                        <span>{{ $artist->albums_count ?? $artist->albums->count() ?? 0 }} albums</span>
                    </div>
                    <div class="flex items-center gap-1">
                        <a href="{{ route('admin.artists.edit', $artist) }}" class="p-1.5 rounded-lg hover:bg-white/10 text-white/60 hover:text-white transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </a>
                        <form method="POST" action="{{ route('admin.artists.destroy', $artist) }}" onsubmit="return confirm('Are you sure you want to delete this artist?')">
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
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            <p class="text-white/40">No artists found</p>
            <a href="{{ route('admin.artists.create') }}" class="btn-primary mt-4 inline-flex">Create your first artist</a>
        </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $artists->links() }}
    </div>
</div>
@endsection
