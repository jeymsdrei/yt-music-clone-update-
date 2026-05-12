<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\TrendingController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\SongController as AdminSongController;
use App\Http\Controllers\Admin\AlbumController as AdminAlbumController;
use App\Http\Controllers\Admin\ArtistController as AdminArtistController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\PlaylistController as AdminPlaylistController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\Admin\SettingsController as AdminSettingsController;

// Guest routes
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Authenticated user routes
Route::middleware('auth')->group(function () {
    // Main pages
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/explore', [ExploreController::class, 'index'])->name('explore');
    Route::get('/trending', [TrendingController::class, 'index'])->name('trending');
    Route::get('/library', [LibraryController::class, 'index'])->name('library');
    
    // Search
    Route::get('/search', [SongController::class, 'search'])->name('search');
    
    // Songs
    Route::get('/songs', [SongController::class, 'index'])->name('songs.index');
    Route::get('/songs/{song}', [SongController::class, 'show'])->name('songs.show');
    Route::post('/songs/{song}/increment-play', [SongController::class, 'incrementPlay'])->name('songs.increment-play');
    Route::post('/songs/{song}/like', [SongController::class, 'like'])->name('songs.like');
    Route::get('/songs/{song}/comments', [SongController::class, 'comments'])->name('songs.comments');
    Route::post('/songs/{song}/comments', [SongController::class, 'addComment'])->name('songs.comments.add');
    
    // Albums
    Route::get('/albums', [AlbumController::class, 'index'])->name('albums.index');
    Route::get('/albums/{album}', [AlbumController::class, 'show'])->name('albums.show');
    
    // Artists
    Route::get('/artists', [ArtistController::class, 'index'])->name('artists.index');
    Route::get('/artists/{artist}', [ArtistController::class, 'show'])->name('artists.show');
    
    // Categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');
    
    // Playlists
    Route::get('/playlists', [PlaylistController::class, 'index'])->name('playlists.index');
    Route::get('/playlists/create', [PlaylistController::class, 'create'])->name('playlists.create');
    Route::post('/playlists', [PlaylistController::class, 'store'])->name('playlists.store');
    Route::get('/playlists/{playlist}', [PlaylistController::class, 'show'])->name('playlists.show');
    Route::get('/playlists/{playlist}/edit', [PlaylistController::class, 'edit'])->name('playlists.edit');
    Route::put('/playlists/{playlist}', [PlaylistController::class, 'update'])->name('playlists.update');
    Route::delete('/playlists/{playlist}', [PlaylistController::class, 'destroy'])->name('playlists.destroy');
    Route::post('/playlists/{playlist}/add-song', [PlaylistController::class, 'addSong'])->name('playlists.add-song');
    Route::delete('/playlists/{playlist}/songs/{song}', [PlaylistController::class, 'removeSong'])->name('playlists.remove-song');
    
    // User profile
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::get('/settings', [UserController::class, 'settings'])->name('settings');
    Route::put('/settings', [UserController::class, 'updateSettings'])->name('settings.update');
    Route::get('/liked-songs', [UserController::class, 'likedSongs'])->name('liked-songs');
    Route::get('/recently-played', [UserController::class, 'recentlyPlayed'])->name('recently-played');

    // Admin routes
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('dashboard');
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        
        // Manage Users
        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');
        
        // Manage Songs
        Route::get('/songs', [AdminSongController::class, 'index'])->name('songs.index');
        Route::get('/songs/create', [AdminSongController::class, 'create'])->name('songs.create');
        Route::post('/songs', [AdminSongController::class, 'store'])->name('songs.store');
        Route::get('/songs/{song}/edit', [AdminSongController::class, 'edit'])->name('songs.edit');
        Route::put('/songs/{song}', [AdminSongController::class, 'update'])->name('songs.update');
        Route::delete('/songs/{song}', [AdminSongController::class, 'destroy'])->name('songs.destroy');
        
        // Manage Albums
        Route::get('/albums', [AdminAlbumController::class, 'index'])->name('albums.index');
        Route::get('/albums/create', [AdminAlbumController::class, 'create'])->name('albums.create');
        Route::post('/albums', [AdminAlbumController::class, 'store'])->name('albums.store');
        Route::get('/albums/{album}/edit', [AdminAlbumController::class, 'edit'])->name('albums.edit');
        Route::put('/albums/{album}', [AdminAlbumController::class, 'update'])->name('albums.update');
        Route::delete('/albums/{album}', [AdminAlbumController::class, 'destroy'])->name('albums.destroy');
        
        // Manage Artists
        Route::get('/artists', [AdminArtistController::class, 'index'])->name('artists.index');
        Route::get('/artists/create', [AdminArtistController::class, 'create'])->name('artists.create');
        Route::post('/artists', [AdminArtistController::class, 'store'])->name('artists.store');
        Route::get('/artists/{artist}/edit', [AdminArtistController::class, 'edit'])->name('artists.edit');
        Route::put('/artists/{artist}', [AdminArtistController::class, 'update'])->name('artists.update');
        Route::delete('/artists/{artist}', [AdminArtistController::class, 'destroy'])->name('artists.destroy');
        
        // Manage Categories
        Route::get('/categories', [AdminCategoryController::class, 'index'])->name('categories.index');
        Route::get('/categories/create', [AdminCategoryController::class, 'create'])->name('categories.create');
        Route::post('/categories', [AdminCategoryController::class, 'store'])->name('categories.store');
        Route::get('/categories/{category}/edit', [AdminCategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{category}', [AdminCategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [AdminCategoryController::class, 'destroy'])->name('categories.destroy');
        
        // Manage Playlists
        Route::get('/playlists', [AdminPlaylistController::class, 'index'])->name('playlists.index');
        Route::delete('/playlists/{playlist}', [AdminPlaylistController::class, 'destroy'])->name('playlists.destroy');
        
        // Manage Comments
        Route::get('/comments', [AdminCommentController::class, 'index'])->name('comments.index');
        Route::delete('/comments/{comment}', [AdminCommentController::class, 'destroy'])->name('comments.destroy');
        
        // Settings
        Route::get('/settings', [AdminSettingsController::class, 'index'])->name('settings');
        Route::put('/settings', [AdminSettingsController::class, 'update'])->name('settings.update');
    });
});

// Fallback
Route::fallback(function () {
    return redirect()->route('welcome');
});
