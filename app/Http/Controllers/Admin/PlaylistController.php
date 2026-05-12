<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Playlist;

class PlaylistController extends Controller
{
    public function index()
    {
        $playlists = Playlist::with('user')->withCount('songs')->latest()->paginate(20);

        return view('admin.playlists.index', compact('playlists'));
    }

    public function destroy($id)
    {
        $playlist = Playlist::findOrFail($id);
        $playlist->delete();

        return redirect()->route('admin.playlists.index')
            ->with('success', 'Playlist deleted successfully.');
    }
}
