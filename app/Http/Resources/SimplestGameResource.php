<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class SimplestGameResource extends Resource
{
    public function toArray($request)
    {

        return [

            'id'=> $this->id,
            'title'=> $this->title,
            'image'=> 'http://localhost:8000/storage/'.$this->image,
            'base_price'=> $this->base_price,
            'sale_price'=> $this->sale_price,
            'is_on_sale'=> $this->is_on_sale,
            'count'=> $this->count

        ];

    }
}
