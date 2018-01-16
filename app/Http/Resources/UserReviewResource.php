<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class UserReviewResource extends Resource
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
            'recommended'=> $this->recommended,
            'body'=> $this->body,
            'created'=> $this->created_at

        ];

    }
}
