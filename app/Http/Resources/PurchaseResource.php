<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class PurchaseResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'order'=> $this->order_id,
            'date'=> $this->created_at,
            'item'=> $this->title,
            'total'=> $this->actual_price,
            'game_id'=> $this->game_id
        ];
    }

}
