<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class GenreResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'genre'=> $this->genre
        ];
    }

}
