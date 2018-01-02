<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

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

            'title'=> $this->title,
            'image'=> $this->image,
            'release_date'=> $this->release_date,
            'description'=> $this->description,
            'about'=> $this->about,
            'developer'=> $this->developer,
            'publisher'=> $this->publisher,
            'base_price'=> $this->base_price,
            'sale_price'=> $this->sale_price,
            'is_on_sale'=> $this->is_on_sale,

        ];

    }
}
