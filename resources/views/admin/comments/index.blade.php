@extends('layouts.admin')

@section('title', 'Comments')

@section('content')
<div class="space-y-6">
    <div>
        <h2 class="text-2xl font-bold">Comment Moderation</h2>
        <p class="text-white/60 mt-1">Review and manage user comments</p>
    </div>

    <div class="glass-card rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-white/60 border-b border-white/10 bg-white/[0.02]">
                        <th class="text-left py-4 px-4 font-medium">ID</th>
                        <th class="text-left py-4 px-4 font-medium">User</th>
                        <th class="text-left py-4 px-4 font-medium">Song</th>
                        <th class="text-left py-4 px-4 font-medium">Comment</th>
                        <th class="text-left py-4 px-4 font-medium">Date</th>
                        <th class="text-right py-4 px-4 font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($comments as $comment)
                    <tr class="border-b border-white/5 hover:bg-white/[0.02] transition-colors">
                        <td class="py-4 px-4 text-white/60">{{ $comment->id }}</td>
                        <td class="py-4 px-4">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 rounded-full bg-gradient-to-br from-red-500 to-red-700 flex items-center justify-center text-xs font-bold">
                                    {{ substr($comment->user->name ?? 'U', 0, 1) }}
                                </div>
                                <span class="text-white/80">{{ $comment->user->name ?? 'Unknown' }}</span>
                            </div>
                        </td>
                        <td class="py-4 px-4 max-w-[200px] truncate">
                            <span class="text-white/80">{{ $comment->song->title ?? 'Deleted Song' }}</span>
                        </td>
                        <td class="py-4 px-4 max-w-[300px]">
                            <p class="truncate text-white/60">{{ $comment->content ?? $comment->body ?? $comment->comment }}</p>
                        </td>
                        <td class="py-4 px-4 text-white/40">{{ $comment->created_at->diffForHumans() }}</td>
                        <td class="py-4 px-4 text-right">
                            <form method="POST" action="{{ route('admin.comments.destroy', $comment) }}" onsubmit="return confirm('Are you sure you want to delete this comment?')">
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
                        <td colspan="6" class="py-12 text-center text-white/40">No comments found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $comments->links() }}
    </div>
</div>
@endsection
