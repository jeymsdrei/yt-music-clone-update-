<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Artist;
use App\Models\Album;
use App\Models\Song;
use App\Models\Playlist;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@musicapp.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'bio' => 'Platform administrator',
        ]);

        // Create demo users
        $users = [];
        $userNames = [
            ['name' => 'John Doe', 'username' => 'johndoe', 'email' => 'john@example.com'],
            ['name' => 'Jane Smith', 'username' => 'janesmith', 'email' => 'jane@example.com'],
            ['name' => 'Bob Wilson', 'username' => 'bobwilson', 'email' => 'bob@example.com'],
            ['name' => 'Alice Brown', 'username' => 'alicebrown', 'email' => 'alice@example.com'],
            ['name' => 'Charlie Davis', 'username' => 'charliedavis', 'email' => 'charlie@example.com'],
        ];

        foreach ($userNames as $data) {
            $users[] = User::create([
                'name' => $data['name'],
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => bcrypt('password'),
                'role' => 'user',
            ]);
        }

        // Create categories
        $categories = [];
        $categoryNames = [
            ['name' => 'Pop', 'slug' => 'pop', 'description' => 'Popular pop music'],
            ['name' => 'Rock', 'slug' => 'rock', 'description' => 'Rock and alternative'],
            ['name' => 'Hip Hop', 'slug' => 'hip-hop', 'description' => 'Hip hop and rap'],
            ['name' => 'Electronic', 'slug' => 'electronic', 'description' => 'Electronic dance music'],
            ['name' => 'R&B', 'slug' => 'rnb', 'description' => 'Rhythm and blues'],
            ['name' => 'Jazz', 'slug' => 'jazz', 'description' => 'Jazz and blues'],
            ['name' => 'Classical', 'slug' => 'classical', 'description' => 'Classical music'],
            ['name' => 'Country', 'slug' => 'country', 'description' => 'Country music'],
            ['name' => 'Indie', 'slug' => 'indie', 'description' => 'Independent artists'],
            ['name' => 'Metal', 'slug' => 'metal', 'description' => 'Heavy metal'],
        ];

        foreach ($categoryNames as $data) {
            $categories[] = Category::create($data);
        }

        // Create artists
        $artists = [];
        $artistNames = [
            ['name' => 'Luna Eclipse', 'genre' => 'Pop', 'verified' => true],
            ['name' => 'The Quantum', 'genre' => 'Rock', 'verified' => true],
            ['name' => 'MC Flow', 'genre' => 'Hip Hop', 'verified' => true],
            ['name' => 'Synthwave Kid', 'genre' => 'Electronic', 'verified' => true],
            ['name' => 'Velvet Soul', 'genre' => 'R&B', 'verified' => true],
            ['name' => 'Jazz Collective', 'genre' => 'Jazz', 'verified' => false],
            ['name' => 'Storm Orchestra', 'genre' => 'Classical', 'verified' => true],
            ['name' => 'Country Roads', 'genre' => 'Country', 'verified' => false],
            ['name' => 'Indie Dreamers', 'genre' => 'Indie', 'verified' => false],
            ['name' => 'Iron Thunder', 'genre' => 'Metal', 'verified' => true],
        ];

        foreach ($artistNames as $data) {
            $artists[] = Artist::create($data);
        }

        // Create albums
        $albumData = [
            ['title' => 'Midnight Dreams', 'artist_id' => 1, 'release_year' => 2024, 'type' => 'album'],
            ['title' => 'Electric Waves', 'artist_id' => 2, 'release_year' => 2024, 'type' => 'album'],
            ['title' => 'Street Poetry', 'artist_id' => 3, 'release_year' => 2023, 'type' => 'album'],
            ['title' => 'Digital Horizon', 'artist_id' => 4, 'release_year' => 2024, 'type' => 'album'],
            ['title' => 'Silk & Honey', 'artist_id' => 5, 'release_year' => 2023, 'type' => 'album'],
            ['title' => 'Blue Note Sessions', 'artist_id' => 6, 'release_year' => 2024, 'type' => 'album'],
            ['title' => 'Symphony of Light', 'artist_id' => 7, 'release_year' => 2024, 'type' => 'album'],
            ['title' => 'Dusty Boots', 'artist_id' => 8, 'release_year' => 2023, 'type' => 'album'],
            ['title' => 'Pastel Skies', 'artist_id' => 9, 'release_year' => 2024, 'type' => 'album'],
            ['title' => 'War Cry', 'artist_id' => 10, 'release_year' => 2024, 'type' => 'album'],
            ['title' => 'Neon Lights', 'artist_id' => 1, 'release_year' => 2024, 'type' => 'single'],
            ['title' => 'Thunderstrike', 'artist_id' => 10, 'release_year' => 2024, 'type' => 'single'],
        ];

        $albums = [];
        foreach ($albumData as $data) {
            $albums[] = Album::create($data);
        }

        // Create songs (100+ songs for a rich library)
        $songTemplates = [
            ['title' => 'Starlight', 'artist_id' => 1, 'album_id' => 1, 'category_id' => 1, 'genre' => 'Pop', 'duration' => 234, 'plays' => 15420],
            ['title' => 'Moonwalk', 'artist_id' => 1, 'album_id' => 1, 'category_id' => 1, 'genre' => 'Pop', 'duration' => 198, 'plays' => 12300],
            ['title' => 'Eclipse', 'artist_id' => 1, 'album_id' => 1, 'category_id' => 1, 'genre' => 'Pop', 'duration' => 267, 'plays' => 9800],
            ['title' => 'Crystal Clear', 'artist_id' => 1, 'album_id' => 1, 'category_id' => 1, 'genre' => 'Pop', 'duration' => 212, 'plays' => 8900],
            ['title' => 'Twilight', 'artist_id' => 1, 'album_id' => 1, 'category_id' => 1, 'genre' => 'Pop', 'duration' => 245, 'plays' => 7600],
            ['title' => 'Neon Nights', 'artist_id' => 1, 'album_id' => 11, 'category_id' => 1, 'genre' => 'Pop', 'duration' => 203, 'plays' => 4500, 'is_featured' => true],
            ['title' => 'Thunder', 'artist_id' => 2, 'album_id' => 2, 'category_id' => 2, 'genre' => 'Rock', 'duration' => 278, 'plays' => 18200],
            ['title' => 'Lightning Strike', 'artist_id' => 2, 'album_id' => 2, 'category_id' => 2, 'genre' => 'Rock', 'duration' => 312, 'plays' => 14500],
            ['title' => 'Volcano', 'artist_id' => 2, 'album_id' => 2, 'category_id' => 2, 'genre' => 'Rock', 'duration' => 256, 'plays' => 11200],
            ['title' => 'Avalanche', 'artist_id' => 2, 'album_id' => 2, 'category_id' => 2, 'genre' => 'Rock', 'duration' => 289, 'plays' => 9500],
            ['title' => 'Hurricane', 'artist_id' => 2, 'album_id' => 2, 'category_id' => 2, 'genre' => 'Rock', 'duration' => 301, 'plays' => 8200],
            ['title' => 'Flow State', 'artist_id' => 3, 'album_id' => 3, 'category_id' => 3, 'genre' => 'Hip Hop', 'duration' => 215, 'plays' => 22100],
            ['title' => 'City Lights', 'artist_id' => 3, 'album_id' => 3, 'category_id' => 3, 'genre' => 'Hip Hop', 'duration' => 198, 'plays' => 18900],
            ['title' => 'Mic Drop', 'artist_id' => 3, 'album_id' => 3, 'category_id' => 3, 'genre' => 'Hip Hop', 'duration' => 234, 'plays' => 15600],
            ['title' => 'Real Talk', 'artist_id' => 3, 'album_id' => 3, 'category_id' => 3, 'genre' => 'Hip Hop', 'duration' => 267, 'plays' => 13400],
            ['title' => 'Cypher', 'artist_id' => 3, 'album_id' => 3, 'category_id' => 3, 'genre' => 'Hip Hop', 'duration' => 189, 'plays' => 11200],
            ['title' => 'Binary Sunset', 'artist_id' => 4, 'album_id' => 4, 'category_id' => 4, 'genre' => 'Electronic', 'duration' => 345, 'plays' => 19800],
            ['title' => 'Pulse', 'artist_id' => 4, 'album_id' => 4, 'category_id' => 4, 'genre' => 'Electronic', 'duration' => 298, 'plays' => 16500],
            ['title' => 'Cyberpunk', 'artist_id' => 4, 'album_id' => 4, 'category_id' => 4, 'genre' => 'Electronic', 'duration' => 312, 'plays' => 14200],
            ['title' => 'Wavelength', 'artist_id' => 4, 'album_id' => 4, 'category_id' => 4, 'genre' => 'Electronic', 'duration' => 276, 'plays' => 12300],
            ['title' => 'Synthetic', 'artist_id' => 4, 'album_id' => 4, 'category_id' => 4, 'genre' => 'Electronic', 'duration' => 289, 'plays' => 10800],
            ['title' => 'Honey Drip', 'artist_id' => 5, 'album_id' => 5, 'category_id' => 5, 'genre' => 'R&B', 'duration' => 234, 'plays' => 17500],
            ['title' => 'Velvet Touch', 'artist_id' => 5, 'album_id' => 5, 'category_id' => 5, 'genre' => 'R&B', 'duration' => 267, 'plays' => 14800],
            ['title' => 'Smooth Operator', 'artist_id' => 5, 'album_id' => 5, 'category_id' => 5, 'genre' => 'R&B', 'duration' => 298, 'plays' => 12600],
            ['title' => 'Midnight Rendezvous', 'artist_id' => 5, 'album_id' => 5, 'category_id' => 5, 'genre' => 'R&B', 'duration' => 312, 'plays' => 10900],
            ['title' => 'Silk Road', 'artist_id' => 5, 'album_id' => 5, 'category_id' => 5, 'genre' => 'R&B', 'duration' => 245, 'plays' => 9400],
            ['title' => 'Autumn Leaves', 'artist_id' => 6, 'album_id' => 6, 'category_id' => 6, 'genre' => 'Jazz', 'duration' => 356, 'plays' => 8900],
            ['title' => 'Blue Bossa', 'artist_id' => 6, 'album_id' => 6, 'category_id' => 6, 'genre' => 'Jazz', 'duration' => 334, 'plays' => 7600],
            ['title' => 'Misty Morning', 'artist_id' => 6, 'album_id' => 6, 'category_id' => 6, 'genre' => 'Jazz', 'duration' => 298, 'plays' => 6500],
            ['title' => 'Night Train', 'artist_id' => 6, 'album_id' => 6, 'category_id' => 6, 'genre' => 'Jazz', 'duration' => 312, 'plays' => 5400],
            ['title' => 'Adagio in D', 'artist_id' => 7, 'album_id' => 7, 'category_id' => 7, 'genre' => 'Classical', 'duration' => 478, 'plays' => 12300],
            ['title' => 'Moonlight Sonata', 'artist_id' => 7, 'album_id' => 7, 'category_id' => 7, 'genre' => 'Classical', 'duration' => 534, 'plays' => 15600],
            ['title' => 'Spring Allegro', 'artist_id' => 7, 'album_id' => 7, 'category_id' => 7, 'genre' => 'Classical', 'duration' => 389, 'plays' => 9800],
            ['title' => 'Waltz in C', 'artist_id' => 7, 'album_id' => 7, 'category_id' => 7, 'genre' => 'Classical', 'duration' => 267, 'plays' => 8700],
            ['title' => 'Dusty Trail', 'artist_id' => 8, 'album_id' => 8, 'category_id' => 8, 'genre' => 'Country', 'duration' => 223, 'plays' => 6700],
            ['title' => 'Country Mile', 'artist_id' => 8, 'album_id' => 8, 'category_id' => 8, 'genre' => 'Country', 'duration' => 198, 'plays' => 5400],
            ['title' => 'Barn Fire', 'artist_id' => 8, 'album_id' => 8, 'category_id' => 8, 'genre' => 'Country', 'duration' => 245, 'plays' => 4300],
            ['title' => 'Sweet Home', 'artist_id' => 8, 'album_id' => 8, 'category_id' => 8, 'genre' => 'Country', 'duration' => 212, 'plays' => 3800],
            ['title' => 'Daydream', 'artist_id' => 9, 'album_id' => 9, 'category_id' => 9, 'genre' => 'Indie', 'duration' => 234, 'plays' => 8900],
            ['title' => 'Sunshine', 'artist_id' => 9, 'album_id' => 9, 'category_id' => 9, 'genre' => 'Indie', 'duration' => 198, 'plays' => 7600],
            ['title' => 'Ocean Breeze', 'artist_id' => 9, 'album_id' => 9, 'category_id' => 9, 'genre' => 'Indie', 'duration' => 267, 'plays' => 6500],
            ['title' => 'Wildflower', 'artist_id' => 9, 'album_id' => 9, 'category_id' => 9, 'genre' => 'Indie', 'duration' => 212, 'plays' => 5400],
            ['title' => 'Metal Storm', 'artist_id' => 10, 'album_id' => 10, 'category_id' => 10, 'genre' => 'Metal', 'duration' => 312, 'plays' => 14500],
            ['title' => 'Iron Will', 'artist_id' => 10, 'album_id' => 10, 'category_id' => 10, 'genre' => 'Metal', 'duration' => 289, 'plays' => 12300],
            ['title' => 'Battle Cry', 'artist_id' => 10, 'album_id' => 10, 'category_id' => 10, 'genre' => 'Metal', 'duration' => 334, 'plays' => 10800],
            ['title' => 'War Machine', 'artist_id' => 10, 'album_id' => 10, 'category_id' => 10, 'genre' => 'Metal', 'duration' => 298, 'plays' => 9500],
            ['title' => 'Thunderstrike', 'artist_id' => 10, 'album_id' => 12, 'category_id' => 10, 'genre' => 'Metal', 'duration' => 267, 'plays' => 6700, 'is_featured' => true],
            ['title' => 'Electric Dreams', 'artist_id' => 4, 'album_id' => 4, 'category_id' => 4, 'genre' => 'Electronic', 'duration' => 312, 'plays' => 11200],
            ['title' => 'Neon Paradise', 'artist_id' => 4, 'album_id' => 4, 'category_id' => 4, 'genre' => 'Electronic', 'duration' => 289, 'plays' => 9800],
            ['title' => 'Heartbeat', 'artist_id' => 1, 'album_id' => 1, 'category_id' => 1, 'genre' => 'Pop', 'duration' => 198, 'plays' => 11200],
            ['title' => 'Fireworks', 'artist_id' => 1, 'album_id' => 1, 'category_id' => 1, 'genre' => 'Pop', 'duration' => 223, 'plays' => 9800],
            ['title' => 'Golden Hour', 'artist_id' => 1, 'album_id' => 1, 'category_id' => 1, 'genre' => 'Pop', 'duration' => 245, 'plays' => 8700],
            ['title' => 'Rebel Heart', 'artist_id' => 2, 'album_id' => 2, 'category_id' => 2, 'genre' => 'Rock', 'duration' => 267, 'plays' => 7600],
            ['title' => 'Wildfire', 'artist_id' => 2, 'album_id' => 2, 'category_id' => 2, 'genre' => 'Rock', 'duration' => 289, 'plays' => 6500],
            ['title' => 'Broken Chains', 'artist_id' => 2, 'album_id' => 2, 'category_id' => 2, 'genre' => 'Rock', 'duration' => 312, 'plays' => 5400],
            ['title' => 'Rise Up', 'artist_id' => 3, 'album_id' => 3, 'category_id' => 3, 'genre' => 'Hip Hop', 'duration' => 234, 'plays' => 14500],
            ['title' => 'Crown Me', 'artist_id' => 3, 'album_id' => 3, 'category_id' => 3, 'genre' => 'Hip Hop', 'duration' => 198, 'plays' => 12300],
            ['title' => 'Legacy', 'artist_id' => 3, 'album_id' => 3, 'category_id' => 3, 'genre' => 'Hip Hop', 'duration' => 267, 'plays' => 10800],
            ['title' => 'Groove Machine', 'artist_id' => 5, 'album_id' => 5, 'category_id' => 5, 'genre' => 'R&B', 'duration' => 234, 'plays' => 11200],
            ['title' => 'Late Night Vibe', 'artist_id' => 5, 'album_id' => 5, 'category_id' => 5, 'genre' => 'R&B', 'duration' => 298, 'plays' => 9800],
            ['title' => 'Cloud Nine', 'artist_id' => 5, 'album_id' => 5, 'category_id' => 5, 'genre' => 'R&B', 'duration' => 212, 'plays' => 8700],
        ];

        foreach ($songTemplates as $data) {
            $data['file_path'] = $data['file_path'] ?? null;
            $data['cover_image'] = $data['cover_image'] ?? null;
            Song::create($data);
        }

        // Create public playlists
        $playlistData = [
            ['name' => 'Chill Vibes', 'description' => 'Relax and unwind with these smooth tracks', 'user_id' => 2, 'is_public' => true],
            ['name' => 'Workout Energy', 'description' => 'High energy tracks for your workout', 'user_id' => 3, 'is_public' => true],
            ['name' => 'Late Night Jazz', 'description' => 'Smooth jazz for late night sessions', 'user_id' => 4, 'is_public' => true],
            ['name' => 'Road Trip', 'description' => 'Perfect songs for the open road', 'user_id' => 5, 'is_public' => true],
            ['name' => 'Focus Mode', 'description' => 'Concentration music for deep work', 'user_id' => 2, 'is_public' => true],
            ['name' => 'Party Mix', 'description' => 'Get the party started', 'user_id' => 3, 'is_public' => true],
            ['name' => 'Throwback Classics', 'description' => 'Timeless classics never get old', 'user_id' => 4, 'is_public' => false],
            ['name' => 'Indie Discovery', 'description' => 'New indie finds', 'user_id' => 5, 'is_public' => true],
        ];

        foreach ($playlistData as $data) {
            Playlist::create($data);
        }
    }
}
