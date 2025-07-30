<?php

namespace App\Http\Resources\Client;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'document_type_id' => $this->document_type_id,
            'document_type_name' => $this->whenLoaded('documentType', function () {
                return $this->documentType->name;
            }),
            'document_number' => $this->document_number,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'active' => (bool) $this->active,
            'user_created' => $this->user_created,
            'user_updated' => $this->user_updated,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
