<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class PublisherResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'publisher'=> $this->publisher
        ];
    }

}
