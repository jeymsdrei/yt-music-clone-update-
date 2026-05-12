<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Song extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'artist_id',
        'album_id',
        'category_id',
        'genre',
        'duration',
        'file_path',
        'cover_image',
        'lyrics',
        'plays',
        'is_featured',
    ];

    public function artist(): BelongsTo
    {
        return $this->belongsTo(Artist::class);
    }

    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function playlists(): BelongsToMany
    {
        return $this->belongsToMany(Playlist::class)->withPivot('position', 'added_by');
    }

    public function likedByUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, Like::class);
    }

    public function getFilePathUrlAttribute(): string
    {
        return $this->file_path ? asset('storage/' . $this->file_path) : '';
    }

    public function getCoverImageUrlAttribute(): string
    {
        return $this->cover_image ? asset('storage/' . $this->cover_image) : '';
    }

    public function getThumbnailUrlAttribute(): string
    {
        return $this->cover_image_url;
    }

    public function getAudioUrlAttribute(): string
    {
        return $this->file_path_url;
    }

    protected function getDefaultImageAttribute(): string
    {
        return asset('images/default-song.png');
    }
}
