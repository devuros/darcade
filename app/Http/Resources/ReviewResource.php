<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ReviewResource extends Resource
{
    public function toArray($request)
    {
        return [
            'image'=> 'http://localhost:8000/storage/'.$this->image,
            'title'=> $this->title,
            'recommended'=> $this->recommended,
            'body'=> $this->body,
            'created'=> $this->created_at,
            'game_id'=> $this->game_id
        ];
    }

}
