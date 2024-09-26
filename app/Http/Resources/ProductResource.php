<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string,
     *      mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name'=> $this->name,
            'stock' => $this->stock,
            'description' => $this->description,
            'image' => $this->image_url,
            'price' => [
                'normal'=> $this->price,
                'compare'=> $this->compare_price
            ],
            'store_id' => [
                'id' => $this->store_id,
                'name' => $this->store->name,
            ],
            'category' => [
                'id' => $this->category_id,
                'name' => $this->category->name,
            ],
        ];
    }
}
