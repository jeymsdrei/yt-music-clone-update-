<?php

namespace App\Http\Controllers;

use App\Models\Song;

class TrendingController extends Controller
{
    public function index()
    {
        $trendingSongs = Song::with('artist', 'album', 'category')
            ->orderBy('plays', 'desc')
            ->paginate(50);

        return view('trending', compact('trendingSongs'));
    }
}
