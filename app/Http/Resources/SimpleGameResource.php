<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class SimpleGameResource extends Resource
{

    public function toArray($request)
    {

        return [

            'id'=> $this->id,
            'image'=> 'http://localhost:8000/storage/'.$this->image,
            'base_price'=> $this->base_price,
            'sale_price'=> $this->sale_price,
            'is_on_sale'=> $this->is_on_sale

        ];

    }

}
