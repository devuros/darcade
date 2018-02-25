<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ReviewBaseResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'recommended'=> $this->recommended,
            'body'=> $this->body,
            'created'=> $this->created_at
        ];
    }

}
