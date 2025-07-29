<?php

namespace App\Http\Resources\ProductPresentation;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductPresentationComboResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'label' => $this->name,
            'value' => $this->id,
        ];
    }
}
