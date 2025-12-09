<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FeedbackResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'author_name' => $this->name,
            'contact_email' => $this->email,
            'content' => $this->message,
            'category' => $this->category ? $this->category->name : null,
            'tags' => $this->tags->pluck('name'),
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
