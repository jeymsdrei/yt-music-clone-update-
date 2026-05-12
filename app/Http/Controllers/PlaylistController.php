<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Song;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    public function index()
    {
        $userPlaylists = auth()->user()->playlists()->withCount('songs')->latest()->get();
        $publicPlaylists = Playlist::where('is_public', true)
            ->where('user_id', '!=', auth()->id())
            ->with('user')
            ->withCount('songs')
            ->latest()
            ->take(20)
            ->get();

        return view('playlists.index', compact('userPlaylists', 'publicPlaylists'));
    }

    public function create()
    {
        return view('playlists.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'is_public' => 'boolean',
        ]);

        $playlist = auth()->user()->playlists()->create([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'is_public' => $data['is_public'] ?? true,
        ]);

        return redirect()->route('playlists.show', $playlist->id)
            ->with('success', 'Playlist created successfully.');
    }

    public function show($id)
    {
        $playlist = Playlist::with('songs.artist', 'songs.album', 'user')->findOrFail($id);

        if (!$playlist->is_public && $playlist->user_id !== auth()->id()) {
            abort(403);
        }

        return view('playlists.show', compact('playlist'));
    }

    public function edit($id)
    {
        $playlist = Playlist::findOrFail($id);

        if ($playlist->user_id !== auth()->id()) {
            abort(403);
        }

        return view('playlists.edit', compact('playlist'));
    }

    public function update(Request $request, $id)
    {
        $playlist = Playlist::findOrFail($id);

        if ($playlist->user_id !== auth()->id()) {
            abort(403);
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'is_public' => 'boolean',
        ]);

        $playlist->update($data);

        return redirect()->route('playlists.show', $playlist->id)
            ->with('success', 'Playlist updated successfully.');
    }

    public function destroy($id)
    {
        $playlist = Playlist::findOrFail($id);

        if ($playlist->user_id !== auth()->id()) {
            abort(403);
        }

        $playlist->delete();

        return redirect()->route('playlists.index')
            ->with('success', 'Playlist deleted successfully.');
    }

    public function addSong(Request $request, $id)
    {
        $playlist = Playlist::findOrFail($id);

        if ($playlist->user_id !== auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized.'], 403);
        }

        $data = $request->validate([
            'song_id' => 'required|exists:songs,id',
        ]);

        $exists = $playlist->songs()->where('song_id', $data['song_id'])->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Song is already in the playlist.',
            ]);
        }

        $maxPosition = $playlist->songs()->max('position') ?? 0;

        $playlist->songs()->attach($data['song_id'], [
            'position' => $maxPosition + 1,
            'added_by' => auth()->id(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Song added to playlist.',
        ]);
    }

    public function removeSong(Request $request, $id, $songId)
    {
        $playlist = Playlist::findOrFail($id);

        if ($playlist->user_id !== auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized.'], 403);
        }

        $playlist->songs()->detach($songId);

        return response()->json([
            'success' => true,
            'message' => 'Song removed from playlist.',
        ]);
    }
}
