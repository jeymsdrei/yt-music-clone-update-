@extends('layouts.admin')

@section('title', 'Edit Category')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.categories.index') }}" class="p-2 rounded-lg hover:bg-white/10 text-white/60 hover:text-white transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
        </a>
        <div>
            <h2 class="text-2xl font-bold">Edit Category</h2>
            <p class="text-white/60 mt-1">Update category details</p>
        </div>
    </div>

    <div class="glass-card rounded-xl p-6">
        <form method="POST" action="{{ route('admin.categories.update', $category) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-white/80 mb-2">Name *</label>
                <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" class="input-field @error('name') border-red-500 @enderror" required oninput="generateSlug(this.value)">
                @error('name')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-white/80 mb-2">Slug</label>
                <input type="text" name="slug" id="slug" value="{{ old('slug', $category->slug) }}" class="input-field @error('slug') border-red-500 @enderror">
                <p class="mt-1 text-xs text-white/40">Auto-generated from name if left empty</p>
                @error('slug')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-white/80 mb-2">Description</label>
                <textarea name="description" rows="4" class="input-field @error('description') border-red-500 @enderror">{{ old('description', $category->description) }}</textarea>
                @error('description')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-white/80 mb-2">Image</label>
                @if($category->image)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-24 h-24 rounded-lg object-cover border border-white/10">
                </div>
                @endif
                <div class="relative border-2 border-dashed border-white/10 rounded-xl p-6 text-center hover:border-red-500/50 transition-colors cursor-pointer" onclick="document.getElementById('image').click()">
                    <input type="file" id="image" name="image" accept="image/*" class="hidden" onchange="previewFile(this, 'image-preview')">
                    <svg class="w-8 h-8 mx-auto text-white/40 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-sm text-white/60">Upload new image (leave empty to keep current)</p>
                </div>
                <div id="image-preview" class="mt-2 flex gap-2 flex-wrap"></div>
                @error('image')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-white/10">
                <button type="submit" class="btn-primary">Update Category</button>
                <a href="{{ route('admin.categories.index') }}" class="btn-ghost">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function generateSlug(value) {
    const slug = value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
    document.getElementById('slug').value = slug;
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
