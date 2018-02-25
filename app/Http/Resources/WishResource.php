<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class WishResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id'=> $this->wish,
            'game'=> $this->id,
            'title'=> $this->title,
            'image'=> 'http://localhost:8000/storage/'.$this->image,
            'base_price'=> $this->base_price,
            'sale_price'=> $this->sale_price,
            'is_on_sale'=> $this->is_on_sale,
            'created'=> $this->created
        ];
    }

}
