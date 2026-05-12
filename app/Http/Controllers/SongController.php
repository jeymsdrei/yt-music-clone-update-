<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Like;
use App\Models\RecentlyPlayed;
use App\Models\Song;
use Illuminate\Http\Request;

class SongController extends Controller
{
    public function index(Request $request)
    {
        $query = Song::with('artist', 'album', 'category');

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('genre')) {
            $query->where('genre', $request->genre);
        }

        if ($request->filled('artist')) {
            $query->where('artist_id', $request->artist);
        }

        $songs = $query->latest()->paginate(20);

        $categories = Category::all();
        $genres = Song::select('genre')->distinct()->whereNotNull('genre')->pluck('genre');

        return view('songs.index', compact('songs', 'categories', 'genres'));
    }

    public function show($id)
    {
        $song = Song::with('artist', 'album', 'category', 'comments.user')->findOrFail($id);

        $song->increment('plays');

        $relatedSongs = Song::where('artist_id', $song->artist_id)
            ->where('id', '!=', $song->id)
            ->with('artist', 'album')
            ->latest()
            ->take(5)
            ->get();

        if (auth()->check()) {
            RecentlyPlayed::updateOrCreate(
                [
                    'user_id' => auth()->id(),
                    'song_id' => $song->id,
                ],
                ['played_at' => now()]
            );
        }

        return view('songs.show', compact('song', 'relatedSongs'));
    }

    public function incrementPlay($id)
    {
        $song = Song::findOrFail($id);
        $song->increment('plays');

        if (auth()->check()) {
            RecentlyPlayed::updateOrCreate(
                [
                    'user_id' => auth()->id(),
                    'song_id' => $song->id,
                ],
                ['played_at' => now()]
            );
        }

        return response()->json(['success' => true, 'plays' => $song->plays]);
    }

    public function search(Request $request)
    {
        $query = $request->get('q', '');

        if ($request->expectsJson() || $request->ajax()) {
            if (!$query) {
                return response()->json([]);
            }

            $songs = Song::where('title', 'like', "%{$query}%")
                ->with('artist', 'album')
                ->take(5)
                ->get();

            $artists = \App\Models\Artist::where('name', 'like', "%{$query}%")
                ->take(3)
                ->get();

            $albums = \App\Models\Album::where('title', 'like', "%{$query}%")
                ->with('artist')
                ->take(3)
                ->get();

            return response()->json([
                'songs' => $songs,
                'artists' => $artists,
                'albums' => $albums,
            ]);
        }

        $songs = Song::where('title', 'like', "%{$query}%")
            ->with('artist', 'album')
            ->paginate(10);

        $artists = \App\Models\Artist::where('name', 'like', "%{$query}%")
            ->get();

        $albums = \App\Models\Album::where('title', 'like', "%{$query}%")
            ->with('artist')
            ->get();

        return view('search', compact('query', 'songs', 'artists', 'albums'));
    }

    public function like($id)
    {
        $song = Song::findOrFail($id);
        $user = auth()->user();

        $existing = Like::where('user_id', $user->id)
            ->where('song_id', $song->id)
            ->first();

        if ($existing) {
            $existing->delete();
            $liked = false;
        } else {
            Like::create([
                'user_id' => $user->id,
                'song_id' => $song->id,
            ]);
            $liked = true;
        }

        return response()->json([
            'success' => true,
            'liked' => $liked,
            'likes_count' => $song->likes()->count(),
        ]);
    }

    public function comments($id)
    {
        $song = Song::findOrFail($id);

        $comments = $song->comments()
            ->with('user')
            ->latest()
            ->get();

        return response()->json(['comments' => $comments]);
    }

    public function addComment(Request $request, $id)
    {
        $song = Song::findOrFail($id);

        $data = $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $comment = Comment::create([
            'user_id' => auth()->id(),
            'song_id' => $song->id,
            'body' => $data['body'],
        ]);

        $comment->load('user');

        return response()->json([
            'success' => true,
            'comment' => $comment,
        ]);
    }
}
