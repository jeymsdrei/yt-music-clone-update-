@extends('layouts.admin')

@section('title', 'Edit Artist')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.artists.index') }}" class="p-2 rounded-lg hover:bg-white/10 text-white/60 hover:text-white transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
        </a>
        <div>
            <h2 class="text-2xl font-bold">Edit Artist</h2>
            <p class="text-white/60 mt-1">Update artist details</p>
        </div>
    </div>

    <div class="glass-card rounded-xl p-6">
        <form method="POST" action="{{ route('admin.artists.update', $artist) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="flex items-center gap-4 mb-4">
                <div class="w-16 h-16 rounded-full overflow-hidden bg-gradient-to-br from-red-500/20 to-red-700/20">
                    @if($artist->image)
                    <img src="{{ asset('storage/' . $artist->image) }}" alt="{{ $artist->name }}" class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-red-500/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    @endif
                </div>
                <div>
                    <p class="font-semibold">{{ $artist->name }}</p>
                    <p class="text-sm text-white/60">{{ $artist->songs->count() }} songs</p>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-white/80 mb-2">Name *</label>
                <input type="text" name="name" value="{{ old('name', $artist->name) }}" class="input-field @error('name') border-red-500 @enderror" required>
                @error('name')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-white/80 mb-2">Bio</label>
                <textarea name="bio" rows="5" class="input-field @error('bio') border-red-500 @enderror">{{ old('bio', $artist->bio) }}</textarea>
                @error('bio')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-white/80 mb-2">Genre</label>
                <input type="text" name="genre" value="{{ old('genre', $artist->genre) }}" placeholder="e.g. Rock, Pop, Hip-Hop" class="input-field @error('genre') border-red-500 @enderror">
                @error('genre')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-white/80 mb-2">Profile Image</label>
                @if($artist->image)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $artist->image) }}" alt="{{ $artist->name }}" class="w-24 h-24 rounded-full object-cover border border-white/10">
                </div>
                @endif
                <div class="relative border-2 border-dashed border-white/10 rounded-xl p-6 text-center hover:border-red-500/50 transition-colors cursor-pointer" onclick="document.getElementById('image').click()">
                    <input type="file" id="image" name="image" accept="image/*" class="hidden" onchange="previewFile(this, 'image-preview')">
                    <svg class="w-8 h-8 mx-auto text-white/40 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <p class="text-sm text-white/60">Upload new profile image (leave empty to keep current)</p>
                </div>
                <div id="image-preview" class="mt-2 flex gap-2 flex-wrap"></div>
                @error('image')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-white/80 mb-2">Cover Image</label>
                @if($artist->cover_image)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $artist->cover_image) }}" alt="{{ $artist->name }}" class="w-48 h-24 rounded-lg object-cover border border-white/10">
                </div>
                @endif
                <div class="relative border-2 border-dashed border-white/10 rounded-xl p-6 text-center hover:border-red-500/50 transition-colors cursor-pointer" onclick="document.getElementById('cover_image').click()">
                    <input type="file" id="cover_image" name="cover_image" accept="image/*" class="hidden" onchange="previewFile(this, 'cover-preview')">
                    <svg class="w-8 h-8 mx-auto text-white/40 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-sm text-white/60">Upload new cover image (leave empty to keep current)</p>
                </div>
                <div id="cover-preview" class="mt-2 flex gap-2 flex-wrap"></div>
                @error('cover_image')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-3">
                <input type="checkbox" name="verified" id="verified" value="1" {{ old('verified', $artist->verified) ? 'checked' : '' }} class="w-4 h-4 rounded border-white/20 bg-surface text-red-500 focus:ring-red-500">
                <label for="verified" class="text-sm text-white/80">Verified artist</label>
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-white/10">
                <button type="submit" class="btn-primary">Update Artist</button>
                <a href="{{ route('admin.artists.index') }}" class="btn-ghost">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewFile(input, previewId) {
    const preview = document.getElementById(previewId);
    preview.innerHTML = '';
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'w-24 h-24 rounded-lg object-cover border border-white/10';
            preview.appendChild(img);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
