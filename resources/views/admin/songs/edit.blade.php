@extends('layouts.admin')

@section('title', 'Edit Song')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.songs.index') }}" class="p-2 rounded-lg hover:bg-white/10 text-white/60 hover:text-white transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
        </a>
        <div>
            <h2 class="text-2xl font-bold">Edit Song</h2>
            <p class="text-white/60 mt-1">Update song details</p>
        </div>
    </div>

    <div class="glass-card rounded-xl p-6">
        <form method="POST" action="{{ route('admin.songs.update', $song) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-white/80 mb-2">Title *</label>
                    <input type="text" name="title" value="{{ old('title', $song->title) }}" class="input-field @error('title') border-red-500 @enderror" required>
                    @error('title')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-white/80 mb-2">Artist *</label>
                    <select name="artist_id" class="input-field @error('artist_id') border-red-500 @enderror" required>
                        <option value="">Select Artist</option>
                        @foreach($artists as $artist)
                        <option value="{{ $artist->id }}" {{ old('artist_id', $song->artist_id) == $artist->id ? 'selected' : '' }}>{{ $artist->name }}</option>
                        @endforeach
                    </select>
                    @error('artist_id')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-white/80 mb-2">Album</label>
                    <select name="album_id" class="input-field @error('album_id') border-red-500 @enderror">
                        <option value="">None (Single)</option>
                        @foreach($albums as $album)
                        <option value="{{ $album->id }}" {{ old('album_id', $song->album_id) == $album->id ? 'selected' : '' }}>{{ $album->title }}</option>
                        @endforeach
                    </select>
                    @error('album_id')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-white/80 mb-2">Category</label>
                    <select name="category_id" class="input-field @error('category_id') border-red-500 @enderror">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $song->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-white/80 mb-2">Genre</label>
                    <input type="text" name="genre" value="{{ old('genre', $song->genre) }}" placeholder="e.g. Rock, Pop, Hip-Hop" class="input-field @error('genre') border-red-500 @enderror">
                    @error('genre')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-white/80 mb-2">Duration (seconds) *</label>
                    <input type="number" name="duration" value="{{ old('duration', $song->duration) }}" min="1" class="input-field @error('duration') border-red-500 @enderror" required>
                    @error('duration')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-white/80 mb-2">Audio File</label>
                @if($song->file_path)
                <div class="flex items-center gap-2 mb-3 p-3 rounded-lg bg-white/5">
                    <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2z"/>
                    </svg>
                    <span class="text-sm text-white/80">{{ basename($song->file_path) }}</span>
                </div>
                @endif
                <div class="relative border-2 border-dashed border-white/10 rounded-xl p-8 text-center hover:border-red-500/50 transition-colors cursor-pointer" onclick="document.getElementById('audio-file').click()">
                    <input type="file" id="audio-file" name="file" accept=".mp3,.wav,.ogg,.flac" class="hidden" onchange="updateFileInfo(this, 'file-info')">
                    <svg class="w-10 h-10 mx-auto text-white/40 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/>
                    </svg>
                    <p class="text-sm text-white/60">Click to upload or drag and drop (leave empty to keep current file)</p>
                    <p class="text-xs text-white/40 mt-1">MP3, WAV, OGG, FLAC (max 50MB)</p>
                </div>
                <div id="file-info" class="mt-2 text-sm text-white/60"></div>
                @error('file')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-white/80 mb-2">Cover Image</label>
                @if($song->cover)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $song->cover) }}" alt="{{ $song->title }}" class="w-24 h-24 rounded-lg object-cover border border-white/10">
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

            <div>
                <label class="block text-sm font-medium text-white/80 mb-2">Lyrics</label>
                <textarea name="lyrics" rows="6" class="input-field @error('lyrics') border-red-500 @enderror">{{ old('lyrics', $song->lyrics) }}</textarea>
                @error('lyrics')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-3">
                <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $song->is_featured) ? 'checked' : '' }} class="w-4 h-4 rounded border-white/20 bg-surface text-red-500 focus:ring-red-500">
                <label for="is_featured" class="text-sm text-white/80">Mark as featured</label>
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-white/10">
                <button type="submit" class="btn-primary">Update Song</button>
                <a href="{{ route('admin.songs.index') }}" class="btn-ghost">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function updateFileInfo(input, infoId) {
    const info = document.getElementById(infoId);
    if (input.files && input.files[0]) {
        const file = input.files[0];
        const size = (file.size / (1024 * 1024)).toFixed(2);
        info.innerHTML = `<span class="text-green-400">${file.name}</span> (${size} MB)`;
    }
}

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
