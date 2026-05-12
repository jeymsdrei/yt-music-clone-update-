<?php

namespace App\Http\Controllers;

use App\Models\RecentlyPlayed;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile()
    {
        $user = auth()->user()->load('playlists', 'likes.song.artist', 'recentlyPlayed.song.artist');

        return view('user.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'bio' => 'nullable|string|max:1000',
        ]);

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $user->update($data);

        return back()->with('success', 'Profile updated successfully.');
    }

    public function settings()
    {
        $user = auth()->user();
        return view('user.settings', compact('user'));
    }

    public function updateSettings(Request $request)
    {
        $user = auth()->user();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($data);

        if ($request->filled('password')) {
            $request->validate([
                'current_password' => 'required|current_password',
                'password' => 'required|string|min:8|confirmed',
            ]);
            $user->update(['password' => bcrypt($request->password)]);
        }

        return back()->with('success', 'Settings updated successfully.');
    }

    public function likedSongs()
    {
        $songs = auth()->user()->likes()
            ->with('song.artist', 'song.album')
            ->latest()
            ->paginate(20);

        return view('user.liked-songs', compact('songs'));
    }

    public function recentlyPlayed()
    {
        $recentlyPlayed = RecentlyPlayed::where('user_id', auth()->id())
            ->with('song.artist', 'song.album')
            ->latest('played_at')
            ->paginate(20);

        return view('user.recently-played', compact('recentlyPlayed'));
    }
}
