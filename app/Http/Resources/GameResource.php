<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

use App\Http\Resources\GenreResource;
use App\Http\Resources\DeveloperResource;
use App\Http\Resources\PublisherResource;

class GameResource extends Resource
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
            'title'=> $this->title,
            'image'=> $this->image,
            'release_date'=> $this->release_date,
            'description'=> $this->description,
            'about'=> $this->about,
            'developer'=> new DeveloperResource($this->developer),
            'publisher'=> new PublisherResource($this->publisher),
            'base_price'=> $this->base_price,
            'sale_price'=> $this->sale_price,
            'is_on_sale'=> $this->is_on_sale,
            'genres'=> GenreResource::collection($this->genres)

        ];

    }
}
