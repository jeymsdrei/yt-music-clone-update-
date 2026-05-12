<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use App\Models\Category;
use App\Models\Song;
use Illuminate\Http\Request;

class ExploreController extends Controller
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
        $categories = Category::withCount('songs')->get();
        $artists = Artist::withCount('songs')->latest()->take(20)->get();
        $albums = Album::with('artist')->withCount('songs')->latest()->take(20)->get();
        $genres = Song::select('genre')->distinct()->whereNotNull('genre')->pluck('genre');

        return view('explore', compact('songs', 'categories', 'artists', 'albums', 'genres'));
    }
}
