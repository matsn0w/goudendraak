<?php

namespace App\Http\Resources;

use App\Models\MenuCategory;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuItemResource extends JsonResource
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
            'name' => $this->name,
            'number' => $this->number,
            'number_addition' => $this->number_addition,
            'category' => new MenuCategoryResource($this->category),
            'price' => $this->price,
            'description' => $this->description,
            'amount' => $this->whenPivotLoaded('order_item', function () {
                return $this->pivot->amount;
            }),
            'notes' => $this->whenPivotLoaded('order_item', function () {
                return $this->pivot->notes;
            }),
        ];
    }
}
