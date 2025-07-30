<?php

namespace App\Http\Resources\PurchaseDocumentType;

use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseDocumentTypeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'active' => (bool) $this->active,
            'user_created' => $this->user_created,
            'user_updated' => $this->user_updated,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
