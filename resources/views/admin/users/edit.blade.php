@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.users.index') }}" class="p-2 rounded-lg hover:bg-white/10 text-white/60 hover:text-white transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
        </a>
        <div>
            <h2 class="text-2xl font-bold">Edit User</h2>
            <p class="text-white/60 mt-1">Update user information</p>
        </div>
    </div>

    <div class="glass-card rounded-xl p-6">
        <form method="POST" action="{{ route('admin.users.update', $user) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="flex items-center gap-4 mb-6">
                <div class="w-16 h-16 rounded-full bg-gradient-to-br from-red-500 to-red-700 flex items-center justify-center text-xl font-bold overflow-hidden">
                    @if($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="" class="w-full h-full object-cover">
                    @else
                    {{ substr($user->name, 0, 1) }}
                    @endif
                </div>
                <div>
                    <p class="font-semibold">{{ $user->name }}</p>
                    <p class="text-sm text-white/60">Member since {{ $user->created_at->format('M Y') }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-white/80 mb-2">Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="input-field @error('name') border-red-500 @enderror">
                    @error('name')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-white/80 mb-2">Username</label>
                    <input type="text" name="username" value="{{ old('username', $user->username) }}" class="input-field @error('username') border-red-500 @enderror">
                    @error('username')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-white/80 mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="input-field @error('email') border-red-500 @enderror">
                @error('email')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-white/80 mb-2">Bio</label>
                <textarea name="bio" rows="3" class="input-field @error('bio') border-red-500 @enderror">{{ old('bio', $user->bio) }}</textarea>
                @error('bio')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-white/80 mb-2">Role</label>
                    <select name="role" class="input-field @error('role') border-red-500 @enderror">
                        <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    @error('role')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-white/80 mb-2">Avatar Image</label>
                <input type="file" name="avatar" accept="image/*" class="input-field @error('avatar') border-red-500 @enderror" onchange="previewFile(this, 'avatar-preview')">
                <div id="avatar-preview" class="mt-2"></div>
                @error('avatar')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-white/10">
                <button type="submit" class="btn-primary">Update User</button>
                <a href="{{ route('admin.users.index') }}" class="btn-ghost">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewFile(input, previewId) {
    const preview = document.getElementById(previewId);
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `<img src="${e.target.result}" class="w-24 h-24 rounded-lg object-cover border border-white/10">`;
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.innerHTML = '';
    }
}
</script>
@endpush
