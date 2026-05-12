<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Artist;
use App\Models\Comment;
use App\Models\Song;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'users' => User::count(),
            'songs' => Song::count(),
            'plays' => Song::sum('plays'),
            'artists' => Artist::count(),
            'albums' => Album::count(),
            'comments' => Comment::count(),
        ];

        $recentUsers = User::latest()->take(5)->get();
        $topSongs = Song::with('artist')->orderBy('plays', 'desc')->take(5)->get();
        $recentSongs = Song::with('artist', 'album')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentUsers', 'topSongs', 'recentSongs'));
    }
}
