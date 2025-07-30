<?php

namespace App\Http\Resources\PurchaseDocumentType;

use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseDocumentTypeComboResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'label' => $this->name,
            'value' => $this->id,
            'code' => $this->code,
        ];
    }
}
