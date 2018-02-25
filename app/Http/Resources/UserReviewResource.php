<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\Http\Resources\UserResource;

class UserReviewResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'user_id'=> $this->user_id,
            'recommended'=> $this->recommended,
            'body'=> $this->body,
            'created'=> $this->created_at,
            'name'=> $this->name
        ];
    }

}
