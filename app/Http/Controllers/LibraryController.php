<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use App\Models\RecentlyPlayed;

class LibraryController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $playlists = $user->playlists()->withCount('songs')->latest()->get();

        $likes = $user->likes()
            ->with('song.artist', 'song.album')
            ->latest()
            ->take(50)
            ->get();

        $recentlyPlayed = RecentlyPlayed::where('user_id', $user->id)
            ->with('song.artist', 'song.album')
            ->latest('played_at')
            ->take(10)
            ->get();

        $albums = Album::with('artist')
            ->withCount('songs')
            ->latest()
            ->take(20)
            ->get();

        $artists = Artist::withCount('songs')
            ->take(20)
            ->get();

        return view('library', compact('playlists', 'likes', 'recentlyPlayed', 'albums', 'artists'));
    }
}
