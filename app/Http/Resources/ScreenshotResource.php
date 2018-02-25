<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ScreenshotResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'source'=> 'http://localhost:8000/storage/'.$this->path,
            'game'=> $this->game_id
        ];
    }

}
