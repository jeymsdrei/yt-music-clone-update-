@extends('layouts.admin')

@section('title', 'Edit Album')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.albums.index') }}" class="p-2 rounded-lg hover:bg-white/10 text-white/60 hover:text-white transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
        </a>
        <div>
            <h2 class="text-2xl font-bold">Edit Album</h2>
            <p class="text-white/60 mt-1">Update album details</p>
        </div>
    </div>

    <div class="glass-card rounded-xl p-6">
        <form method="POST" action="{{ route('admin.albums.update', $album) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-white/80 mb-2">Title *</label>
                    <input type="text" name="title" value="{{ old('title', $album->title) }}" class="input-field @error('title') border-red-500 @enderror" required>
                    @error('title')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-white/80 mb-2">Artist *</label>
                    <select name="artist_id" class="input-field @error('artist_id') border-red-500 @enderror" required>
                        <option value="">Select Artist</option>
                        @foreach($artists as $artist)
                        <option value="{{ $artist->id }}" {{ old('artist_id', $album->artist_id) == $artist->id ? 'selected' : '' }}>{{ $artist->name }}</option>
                        @endforeach
                    </select>
                    @error('artist_id')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-white/80 mb-2">Release Year</label>
                    <input type="number" name="release_year" value="{{ old('release_year', $album->release_year ?? date('Y')) }}" min="1900" max="{{ date('Y') + 1 }}" class="input-field @error('release_year') border-red-500 @enderror">
                    @error('release_year')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-white/80 mb-2">Type</label>
                    <select name="type" class="input-field @error('type') border-red-500 @enderror">
                        <option value="album" {{ old('type', $album->type) === 'album' ? 'selected' : '' }}>Album</option>
                        <option value="single" {{ old('type', $album->type) === 'single' ? 'selected' : '' }}>Single</option>
                        <option value="ep" {{ old('type', $album->type) === 'ep' ? 'selected' : '' }}>EP</option>
                    </select>
                    @error('type')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-white/80 mb-2">Description</label>
                <textarea name="description" rows="4" class="input-field @error('description') border-red-500 @enderror">{{ old('description', $album->description) }}</textarea>
                @error('description')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-white/80 mb-2">Cover Image</label>
                @if($album->cover)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $album->cover) }}" alt="{{ $album->title }}" class="w-24 h-24 rounded-lg object-cover border border-white/10">
                </div>
                @endif
                <div class="relative border-2 border-dashed border-white/10 rounded-xl p-6 text-center hover:border-red-500/50 transition-colors cursor-pointer" onclick="document.getElementById('cover-image').click()">
                    <input type="file" id="cover-image" name="cover" accept="image/*" class="hidden" onchange="previewFile(this, 'cover-preview')">
                    <svg class="w-8 h-8 mx-auto text-white/40 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-sm text-white/60">Upload new cover image (leave empty to keep current)</p>
                </div>
                <div id="cover-preview" class="mt-2 flex gap-2 flex-wrap"></div>
                @error('cover')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-white/10">
                <button type="submit" class="btn-primary">Update Album</button>
                <a href="{{ route('admin.albums.index') }}" class="btn-ghost">Cancel</a>
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
