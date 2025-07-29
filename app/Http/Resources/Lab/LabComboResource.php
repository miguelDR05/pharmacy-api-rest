<?php

namespace App\Http\Resources\Lab;

use Illuminate\Http\Resources\Json\JsonResource;

class LabComboResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'label' => $this->name,
            'value' => $this->id,
        ];
    }
}
