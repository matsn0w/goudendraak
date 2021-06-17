<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'id' => $this->id,
            'date' => $this->created_at->format('d-m-Y'),
            'time' => $this->created_at->format('H:i'),
            'table' => $this->table,
            'items' => MenuItemResource::collection($this->whenLoaded('items')),
            'financial' => [
                'turnover' => $this->turnover,
                'tax' => $this->tax,
                'profit' => $this->profit,
            ],
        ];
    }
}
