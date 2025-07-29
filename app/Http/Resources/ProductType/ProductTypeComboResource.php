<?php

namespace App\Http\Resources\ProductType;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductTypeComboResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'label' => $this->name,
            'value' => $this->id,
        ];
    }
}
