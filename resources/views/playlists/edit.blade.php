@extends('layouts.app')

@section('title', 'Edit Playlist')

@section('content')
<div class="max-w-2xl mx-auto fade-in">
    <div class="mb-8">
        <h1 class="text-2xl md:text-3xl font-bold">Edit Playlist</h1>
        <p class="text-white/40 text-sm mt-1">Update your playlist details</p>
    </div>

    <div class="glass-card rounded-2xl p-6 md:p-8">
        <form action="{{ route('playlists.update', $playlist) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Cover Upload --}}
            <div class="flex flex-col items-center">
                <div class="relative w-48 h-48 rounded-2xl overflow-hidden bg-white/5 group cursor-pointer mb-4" id="cover-preview-container">
                    <div class="w-full h-full flex items-center justify-center {{ $playlist->cover_image ? 'hidden' : '' }}" id="cover-placeholder">
                        <svg class="w-16 h-16 text-white/20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55C7.79 13 6 14.79 6 17s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/></svg>
                    </div>
                    @if($playlist->cover_image)
                    <img id="cover-preview" src="{{ asset('storage/' . $playlist->cover_image) }}" class="w-full h-full object-cover absolute inset-0">
                    @else
                    <img id="cover-preview" class="hidden w-full h-full object-cover absolute inset-0">
                    @endif
                    <div class="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                        <span class="text-sm font-medium">Change Cover</span>
                    </div>
                </div>
                <input type="file" name="cover_image" id="cover-input" class="hidden" accept="image/*">
                <label for="cover-input" class="text-sm text-white/40 hover:text-white cursor-pointer transition-colors">Choose new image</label>
            </div>

            {{-- Name --}}
            <div>
                <label class="block text-sm font-medium text-white/60 mb-1.5">Playlist Name</label>
                <input type="text" name="name" value="{{ old('name', $playlist->name) }}" class="input-field" required>
                @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div>
                <label class="block text-sm font-medium text-white/60 mb-1.5">Description <span class="text-white/20">(optional)</span></label>
                <textarea name="description" rows="3" class="input-field resize-none" placeholder="Add a description...">{{ old('description', $playlist->description) }}</textarea>
                @error('description')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Visibility Toggle --}}
            <div class="flex items-center justify-between">
                <div>
                    <p class="font-medium">Public Playlist</p>
                    <p class="text-sm text-white/40">Anyone can see and follow this playlist</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_public" class="sr-only peer" value="1" {{ $playlist->is_public ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-white/10 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-500"></div>
                </label>
            </div>

            {{-- Submit --}}
            <div class="pt-2">
                <button type="submit" class="btn-primary w-full justify-center shadow-lg shadow-red-500/25">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const coverInput = document.getElementById('cover-input');
        const coverPreview = document.getElementById('cover-preview');
        const coverPlaceholder = document.getElementById('cover-placeholder');
        if (coverInput) {
            coverInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        coverPreview.src = event.target.result;
                        coverPreview.classList.remove('hidden');
                        if (coverPlaceholder) coverPlaceholder.classList.add('hidden');
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    });
</script>
@endpush
