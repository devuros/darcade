<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class DeveloperResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'developer'=> $this->developer
        ];
    }

}
