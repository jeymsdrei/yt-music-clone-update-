<?php

namespace App\Http\Controllers;

use App\Models\Album;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::with('artist', 'songs')
            ->withCount('songs')
            ->latest()
            ->paginate(20);

        return view('albums.index', compact('albums'));
    }

    public function show($id)
    {
        $album = Album::with('artist', 'songs.artist', 'songs.category')->findOrFail($id);

        return view('albums.show', compact('album'));
    }
}
