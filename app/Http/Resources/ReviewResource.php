<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ReviewResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [

            'id'=> $this->id,
            'image'=> $this->game->image,
            'title'=> $this->game->title,
            'recommended'=> $this->recommended,
            'body'=> $this->body,
            'created'=> $this->created_at

        ];

    }
}
