@extends('layouts.admin')

@section('title', 'Songs')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold">Songs</h2>
            <p class="text-white/60 mt-1">Manage all songs on the platform</p>
        </div>
        <a href="{{ route('admin.songs.create') }}" class="btn-primary">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Upload New Song
        </a>
    </div>

    <form method="GET" action="{{ route('admin.songs.index') }}" class="flex gap-3">
        <div class="relative flex-1 max-w-md">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="search" name="search" placeholder="Search songs by title, artist, album..." value="{{ request('search') }}" class="input-field pl-10">
        </div>
        <select name="genre" class="input-field w-40">
            <option value="">All Genres</option>
            @foreach($genres ?? [] as $genre)
            <option value="{{ $genre }}" {{ request('genre') === $genre ? 'selected' : '' }}>{{ $genre }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn-primary">Filter</button>
        @if(request('search') || request('genre'))
        <a href="{{ route('admin.songs.index') }}" class="btn-ghost">Clear</a>
        @endif
    </form>

    <div class="glass-card rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-white/60 border-b border-white/10 bg-white/[0.02]">
                        <th class="text-left py-4 px-4 font-medium">ID</th>
                        <th class="text-left py-4 px-4 font-medium">Cover</th>
                        <th class="text-left py-4 px-4 font-medium">Title</th>
                        <th class="text-left py-4 px-4 font-medium">Artist</th>
                        <th class="text-left py-4 px-4 font-medium">Album</th>
                        <th class="text-left py-4 px-4 font-medium">Genre</th>
                        <th class="text-left py-4 px-4 font-medium">Duration</th>
                        <th class="text-left py-4 px-4 font-medium">Plays</th>
                        <th class="text-left py-4 px-4 font-medium">Featured</th>
                        <th class="text-right py-4 px-4 font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($songs as $song)
                    <tr class="border-b border-white/5 hover:bg-white/[0.02] transition-colors">
                        <td class="py-4 px-4 text-white/60">{{ $song->id }}</td>
                        <td class="py-4 px-4">
                            <div class="w-10 h-10 rounded-lg overflow-hidden bg-surface">
                                @if($song->cover)
                                <img src="{{ asset('storage/' . $song->cover) }}" alt="{{ $song->title }}" class="w-full h-full object-cover">
                                @else
                                <div class="w-full h-full flex items-center justify-center bg-red-500/20">
                                    <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55C7.79 13 6 14.79 6 17s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/>
                                    </svg>
                                </div>
                                @endif
                            </div>
                        </td>
                        <td class="py-4 px-4 font-medium max-w-[200px] truncate">{{ $song->title }}</td>
                        <td class="py-4 px-4 text-white/60">{{ $song->artist->name ?? 'Unknown' }}</td>
                        <td class="py-4 px-4 text-white/60">{{ $song->album->title ?? '-' }}</td>
                        <td class="py-4 px-4">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs bg-white/10 text-white/60">{{ $song->genre ?? '-' }}</span>
                        </td>
                        <td class="py-4 px-4 text-white/60">{{ gmdate('i:s', $song->duration) }}</td>
                        <td class="py-4 px-4 text-white/60">{{ number_format($song->plays) }}</td>
                        <td class="py-4 px-4">
                            @if($song->is_featured)
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-500/20 text-red-400">
                                Featured
                            </span>
                            @else
                            <span class="text-white/30">—</span>
                            @endif
                        </td>
                        <td class="py-4 px-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.songs.edit', $song) }}" class="p-2 rounded-lg hover:bg-white/10 text-white/60 hover:text-white transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form method="POST" action="{{ route('admin.songs.destroy', $song) }}" onsubmit="return confirm('Are you sure you want to delete this song?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 rounded-lg hover:bg-red-500/20 text-white/60 hover:text-red-400 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="py-12 text-center text-white/40">No songs found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $songs->links() }}
    </div>
</div>
@endsection
