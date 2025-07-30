<?php

namespace App\Http\Resources\StorageCondition;

use Illuminate\Http\Resources\Json\JsonResource;

class StorageConditionComboResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'label' => $this->label,
            'value' => $this->id,
            'code' => $this->value, // El 'value' original del seeder puede ser un 'code' adicional
        ];
    }
}
