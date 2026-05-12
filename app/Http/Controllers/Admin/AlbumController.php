<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Artist;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::with('artist')->withCount('songs')->latest()->paginate(20);

        return view('admin.albums.index', compact('albums'));
    }

    public function create()
    {
        $artists = Artist::orderBy('name')->get();

        return view('admin.albums.create', compact('artists'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'artist_id' => 'required|exists:artists,id',
            'release_year' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'type' => 'required|in:album,single,ep,compilation',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        Album::create($data);

        return redirect()->route('admin.albums.index')
            ->with('success', 'Album created successfully.');
    }

    public function edit($id)
    {
        $album = Album::findOrFail($id);
        $artists = Artist::orderBy('name')->get();

        return view('admin.albums.edit', compact('album', 'artists'));
    }

    public function update(Request $request, $id)
    {
        $album = Album::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'artist_id' => 'required|exists:artists,id',
            'release_year' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'type' => 'required|in:album,single,ep,compilation',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        $album->update($data);

        return redirect()->route('admin.albums.index')
            ->with('success', 'Album updated successfully.');
    }

    public function destroy($id)
    {
        $album = Album::findOrFail($id);
        $album->delete();

        return redirect()->route('admin.albums.index')
            ->with('success', 'Album deleted successfully.');
    }
}
