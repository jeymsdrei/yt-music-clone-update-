<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Song;

class HomeController extends Controller
{
    public function index()
    {
        $featuredSongs = Song::where('is_featured', true)
            ->with('artist', 'album')
            ->latest()
            ->take(10)
            ->get();

        $recentSongs = Song::with('artist', 'album')
            ->latest()
            ->take(10)
            ->get();

        $trendingSongs = Song::with('artist', 'album')
            ->orderBy('plays', 'desc')
            ->take(10)
            ->get();

        $recommendedSongs = Song::with('artist', 'album')
            ->inRandomOrder()
            ->take(10)
            ->get();

        $categories = Category::withCount('songs')->get();

        return view('home', compact(
            'featuredSongs',
            'recentSongs',
            'trendingSongs',
            'recommendedSongs',
            'categories'
        ));
    }
}
