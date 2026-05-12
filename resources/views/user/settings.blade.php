@extends('layouts.app')

@section('title', 'Settings')

@section('content')
<div class="max-w-3xl mx-auto space-y-8 fade-in">
    <div>
        <h1 class="text-2xl md:text-3xl font-bold">Settings</h1>
        <p class="text-white/40 text-sm mt-1">Manage your account preferences</p>
    </div>

    {{-- Profile Settings --}}
    <div class="glass-card rounded-2xl p-6 md:p-8">
        <h2 class="text-lg font-semibold mb-6">Profile Information</h2>
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div class="flex flex-col md:flex-row gap-6">
                <div class="flex-shrink-0 text-center md:text-left">
                    <div class="w-24 h-24 rounded-full overflow-hidden bg-white/5 mx-auto md:mx-0 mb-3">
                        @if($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                        @else
                        <div class="w-full h-full bg-gradient-to-br from-red-500 to-red-700 flex items-center justify-center">
                            <span class="text-2xl font-bold text-white">{{ substr($user->name, 0, 1) }}</span>
                        </div>
                        @endif
                    </div>
                    <label class="inline-flex items-center gap-2 text-sm text-white/60 hover:text-white cursor-pointer transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Change Avatar
                        <input type="file" name="avatar" class="hidden" accept="image/*">
                    </label>
                </div>
                <div class="flex-1 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-white/60 mb-1.5">Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="input-field" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-white/60 mb-1.5">Username</label>
                        <input type="text" name="username" value="{{ old('username', $user->username ?? '') }}" class="input-field">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-white/60 mb-1.5">Bio</label>
                        <textarea name="bio" rows="3" class="input-field resize-none">{{ old('bio', $user->bio ?? '') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="pt-2">
                <button type="submit" class="btn-primary">Save Changes</button>
            </div>
        </form>
    </div>

    {{-- Password Change --}}
    <div class="glass-card rounded-2xl p-6 md:p-8">
        <h2 class="text-lg font-semibold mb-6">Change Password</h2>
        <form action="{{ route('settings.update') }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm font-medium text-white/60 mb-1.5">Current Password</label>
                <input type="password" name="current_password" class="input-field" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-white/60 mb-1.5">New Password</label>
                <input type="password" name="password" class="input-field" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-white/60 mb-1.5">Confirm New Password</label>
                <input type="password" name="password_confirmation" class="input-field" required>
            </div>
            <div class="pt-2">
                <button type="submit" class="btn-primary">Update Password</button>
            </div>
        </form>
    </div>

    {{-- Account Preferences --}}
    <div class="glass-card rounded-2xl p-6 md:p-8">
        <h2 class="text-lg font-semibold mb-6">Account Preferences</h2>
        <form action="{{ route('settings.update') }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')
            <div class="flex items-center justify-between">
                <div>
                    <p class="font-medium">Email Notifications</p>
                    <p class="text-sm text-white/40">Receive updates about new releases and recommendations</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="email_notifications" class="sr-only peer" value="1" {{ $user->email_notifications ?? true ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-white/10 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-500"></div>
                </label>
            </div>
            <div class="flex items-center justify-between">
                <div>
                    <p class="font-medium">Private Account</p>
                    <p class="text-sm text-white/40">Hide your playlists and activity from other users</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="private_account" class="sr-only peer" value="1" {{ $user->private_account ?? false ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-white/10 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-500"></div>
                </label>
            </div>
            <div class="flex items-center justify-between">
                <div>
                    <p class="font-medium">Autoplay</p>
                    <p class="text-sm text-white/40">Automatically play similar songs when your music ends</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="autoplay" class="sr-only peer" value="1" {{ $user->autoplay ?? true ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-white/10 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-500"></div>
                </label>
            </div>
            <div class="pt-2">
                <button type="submit" class="btn-primary">Save Preferences</button>
            </div>
        </form>
    </div>
</div>
@endsection
