<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class RoleResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'role'=> $this->role
        ];
    }

}
