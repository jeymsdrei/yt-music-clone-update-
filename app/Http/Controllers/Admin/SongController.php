<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Artist;
use App\Models\Category;
use App\Models\Song;
use Illuminate\Http\Request;

class SongController extends Controller
{
    public function index()
    {
        $songs = Song::with('artist', 'album', 'category')->latest()->paginate(20);

        return view('admin.songs.index', compact('songs'));
    }

    public function create()
    {
        $artists = Artist::orderBy('name')->get();
        $albums = Album::orderBy('title')->get();
        $categories = Category::orderBy('name')->get();

        return view('admin.songs.create', compact('artists', 'albums', 'categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'artist_id' => 'required|exists:artists,id',
            'album_id' => 'nullable|exists:albums,id',
            'category_id' => 'nullable|exists:categories,id',
            'genre' => 'nullable|string|max:255',
            'duration' => 'required|integer|min:0',
            'lyrics' => 'nullable|string',
            'is_featured' => 'boolean',
            'file' => 'required|file|mimes:mp3,wav,ogg,flac,aac|max:102400',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $data['file_path'] = $request->file('file')->store('songs', 'public');

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        $data['is_featured'] = $request->boolean('is_featured');

        Song::create($data);

        return redirect()->route('admin.songs.index')
            ->with('success', 'Song uploaded successfully.');
    }

    public function edit($id)
    {
        $song = Song::findOrFail($id);
        $artists = Artist::orderBy('name')->get();
        $albums = Album::orderBy('title')->get();
        $categories = Category::orderBy('name')->get();

        return view('admin.songs.edit', compact('song', 'artists', 'albums', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $song = Song::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'artist_id' => 'required|exists:artists,id',
            'album_id' => 'nullable|exists:albums,id',
            'category_id' => 'nullable|exists:categories,id',
            'genre' => 'nullable|string|max:255',
            'duration' => 'required|integer|min:0',
            'lyrics' => 'nullable|string',
            'is_featured' => 'boolean',
            'file' => 'nullable|file|mimes:mp3,wav,ogg,flac,aac|max:102400',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        if ($request->hasFile('file')) {
            $data['file_path'] = $request->file('file')->store('songs', 'public');
        }

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        $data['is_featured'] = $request->boolean('is_featured');

        $song->update($data);

        return redirect()->route('admin.songs.index')
            ->with('success', 'Song updated successfully.');
    }

    public function destroy($id)
    {
        $song = Song::findOrFail($id);
        $song->delete();

        return redirect()->route('admin.songs.index')
            ->with('success', 'Song deleted successfully.');
    }
}
