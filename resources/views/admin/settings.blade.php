@extends('layouts.admin')

@section('title', 'Settings')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div>
        <h2 class="text-2xl font-bold">System Settings</h2>
        <p class="text-white/60 mt-1">Configure your platform settings</p>
    </div>

    <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="glass-card rounded-xl p-6 space-y-4">
            <h3 class="text-lg font-semibold">General Settings</h3>

            <div>
                <label class="block text-sm font-medium text-white/80 mb-2">Site Name</label>
                <input type="text" name="site_name" value="{{ old('site_name', config('app.name')) }}" class="input-field @error('site_name') border-red-500 @enderror">
                @error('site_name')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-white/80 mb-2">Site Description</label>
                <textarea name="description" rows="3" class="input-field @error('description') border-red-500 @enderror">{{ old('description', config('app.description', '')) }}</textarea>
                @error('description')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="glass-card rounded-xl p-6 space-y-4">
            <h3 class="text-lg font-semibold">Maintenance</h3>

            <div class="flex items-center justify-between">
                <div>
                    <p class="font-medium">Maintenance Mode</p>
                    <p class="text-sm text-white/60">When enabled, only admins can access the site</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="maintenance_mode" value="1" {{ old('maintenance_mode', app()->isDownForMaintenance()) ? 'checked' : '' }} class="sr-only peer">
                    <div class="w-11 h-6 bg-white/10 rounded-full peer peer-checked:bg-red-500 peer-focus:ring-2 peer-focus:ring-red-500/50 after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full"></div>
                </label>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="btn-primary">Save Settings</button>
        </div>
    </form>
</div>
@endsection
