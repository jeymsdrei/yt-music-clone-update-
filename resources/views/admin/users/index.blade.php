@extends('layouts.admin')

@section('title', 'Users')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold">Users</h2>
            <p class="text-white/60 mt-1">Manage all registered users</p>
        </div>
    </div>

    <form method="GET" action="{{ route('admin.users.index') }}" class="flex gap-3">
        <div class="relative flex-1 max-w-md">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="search" name="search" placeholder="Search users by name, email, or username..." value="{{ request('search') }}" class="input-field pl-10">
        </div>
        <button type="submit" class="btn-primary">Search</button>
        @if(request('search'))
        <a href="{{ route('admin.users.index') }}" class="btn-ghost">Clear</a>
        @endif
    </form>

    <div class="glass-card rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-white/60 border-b border-white/10 bg-white/[0.02]">
                        <th class="text-left py-4 px-4 font-medium">ID</th>
                        <th class="text-left py-4 px-4 font-medium">Avatar</th>
                        <th class="text-left py-4 px-4 font-medium">Name</th>
                        <th class="text-left py-4 px-4 font-medium">Username</th>
                        <th class="text-left py-4 px-4 font-medium">Email</th>
                        <th class="text-left py-4 px-4 font-medium">Role</th>
                        <th class="text-left py-4 px-4 font-medium">Joined</th>
                        <th class="text-right py-4 px-4 font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr class="border-b border-white/5 hover:bg-white/[0.02] transition-colors">
                        <td class="py-4 px-4 text-white/60">{{ $user->id }}</td>
                        <td class="py-4 px-4">
                            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-red-500 to-red-700 flex items-center justify-center text-sm font-bold overflow-hidden">
                                @if($user->avatar)
                                <img src="{{ asset('storage/' . $user->avatar) }}" alt="" class="w-full h-full object-cover">
                                @else
                                {{ substr($user->name, 0, 1) }}
                                @endif
                            </div>
                        </td>
                        <td class="py-4 px-4 font-medium">{{ $user->name }}</td>
                        <td class="py-4 px-4 text-white/60">{{ $user->username }}</td>
                        <td class="py-4 px-4 text-white/60">{{ $user->email }}</td>
                        <td class="py-4 px-4">
                            @if($user->role === 'admin')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-500/20 text-red-400">
                                Admin
                            </span>
                            @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-white/10 text-white/60">
                                User
                            </span>
                            @endif
                        </td>
                        <td class="py-4 px-4 text-white/40">{{ $user->created_at->format('M d, Y') }}</td>
                        <td class="py-4 px-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.users.edit', $user) }}" class="p-2 rounded-lg hover:bg-white/10 text-white/60 hover:text-white transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Are you sure you want to delete this user?')">
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
                        <td colspan="8" class="py-12 text-center text-white/40">No users found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
@endsection
