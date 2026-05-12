<?php

namespace App\Http\Controllers;

use App\Models\Artist;

class ArtistController extends Controller
{
    public function index()
    {
        $artists = Artist::withCount('songs', 'albums')
            ->latest()
            ->paginate(20);

        return view('artists.index', compact('artists'));
    }

    public function show($id)
    {
        $artist = Artist::with('songs.album', 'albums')->findOrFail($id);

        return view('artists.show', compact('artist'));
    }
}
