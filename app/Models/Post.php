<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function booted()
    {
        static::creating(function ($post) {
            $post->slug = \Str::slug($post->title);
            $latestSlug =
                static::whereRaw("slug RLIKE '^{$post->slug}(-[0-9]*)?$'")
                ->latest('id')
                ->pluck('slug')
                ->first();

            if ($latestSlug) {
                $pieces = explode('-', $latestSlug);
                $number = intval(end($pieces));
                $post->slug .= '-' . ($number + 1);
            }
        });

        static::updating(function ($post) {
            $post->slug = \Str::slug($post->title);
            $latestSlug =
                static::whereRaw("slug RLIKE '^{$post->slug}(-[0-9]*)?$'")
                ->latest('id')
                ->pluck('slug')
                ->first();

            if ($latestSlug) {
                $pieces = explode('-', $latestSlug);
                $number = intval(end($pieces));
                $post->slug .= '-' . ($number + 1);
            }
        });
    }

    public function getCoverPathAttribute()
    {
        return $this->cover ? asset('storage/' . $this->cover) : 'https://via.placeholder.com/640x480.png/00ff77?text=No+Image';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
