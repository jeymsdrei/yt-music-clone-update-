@extends('layouts.admin')

@section('title', 'Playlists')

@section('content')
<div class="space-y-6">
    <div>
        <h2 class="text-2xl font-bold">Playlists</h2>
        <p class="text-white/60 mt-1">Manage all user-created playlists</p>
    </div>

    <div class="glass-card rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-white/60 border-b border-white/10 bg-white/[0.02]">
                        <th class="text-left py-4 px-4 font-medium">ID</th>
                        <th class="text-left py-4 px-4 font-medium">Name</th>
                        <th class="text-left py-4 px-4 font-medium">Creator</th>
                        <th class="text-left py-4 px-4 font-medium">Song Count</th>
                        <th class="text-left py-4 px-4 font-medium">Visibility</th>
                        <th class="text-left py-4 px-4 font-medium">Created</th>
                        <th class="text-right py-4 px-4 font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($playlists as $playlist)
                    <tr class="border-b border-white/5 hover:bg-white/[0.02] transition-colors">
                        <td class="py-4 px-4 text-white/60">{{ $playlist->id }}</td>
                        <td class="py-4 px-4 font-medium max-w-[200px] truncate">{{ $playlist->name }}</td>
                        <td class="py-4 px-4">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 rounded-full bg-gradient-to-br from-red-500 to-red-700 flex items-center justify-center text-xs font-bold">
                                    {{ substr($playlist->user->name ?? 'U', 0, 1) }}
                                </div>
                                <span class="text-white/80">{{ $playlist->user->name ?? 'Unknown' }}</span>
                            </div>
                        </td>
                        <td class="py-4 px-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-white/10 text-white/60">
                                {{ $playlist->songs_count ?? $playlist->songs->count() ?? 0 }}
                            </span>
                        </td>
                        <td class="py-4 px-4">
                            @if($playlist->visibility === 'public' || $playlist->is_public)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-500/20 text-green-400">
                                Public
                            </span>
                            @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-white/10 text-white/60">
                                Private
                            </span>
                            @endif
                        </td>
                        <td class="py-4 px-4 text-white/40">{{ $playlist->created_at->format('M d, Y') }}</td>
                        <td class="py-4 px-4 text-right">
                            <form method="POST" action="{{ route('admin.playlists.destroy', $playlist) }}" onsubmit="return confirm('Are you sure you want to delete this playlist?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 rounded-lg hover:bg-red-500/20 text-white/60 hover:text-red-400 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-12 text-center text-white/40">No playlists found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $playlists->links() }}
    </div>
</div>
@endsection
