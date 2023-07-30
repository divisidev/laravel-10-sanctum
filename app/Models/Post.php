<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = [];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
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
