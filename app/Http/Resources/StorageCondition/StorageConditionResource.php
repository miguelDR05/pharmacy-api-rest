<?php

namespace App\Http\Resources\StorageCondition;

use Illuminate\Http\Resources\Json\JsonResource;

class StorageConditionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'label' => $this->label,
            'value' => $this->value,
            'active' => (bool) $this->active,
            'user_created' => $this->user_created,
            'user_updated' => $this->user_updated,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
