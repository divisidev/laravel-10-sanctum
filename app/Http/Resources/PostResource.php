<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'author'        => $this->user->name,
            'title'         => $this->title,
            'slug'          => $this->slug,
            'content'       => $this->content,
            'cover'         => $this->cover_path,
            'is_published'  => $this->is_published ? true : false,
            'created_at'    => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at'    => $this->updated_at->format('Y-m-d H:i:s')
        ];
    }
}
