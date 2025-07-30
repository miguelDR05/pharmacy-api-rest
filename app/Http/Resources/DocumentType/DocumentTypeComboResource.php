<?php

namespace App\Http\Resources\DocumentType;

use Illuminate\Http\Resources\Json\JsonResource;

class DocumentTypeComboResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'label' => $this->name,
            'value' => $this->id,
            'code' => $this->code, // Útil para lógica de frontend
        ];
    }
}
