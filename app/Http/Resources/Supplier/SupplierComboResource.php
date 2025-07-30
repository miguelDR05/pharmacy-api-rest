<?php

namespace App\Http\Resources\Supplier;

use Illuminate\Http\Resources\Json\JsonResource;

class SupplierComboResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'label' => $this->name . ($this->ruc ? ' (' . $this->ruc . ')' : ''),
            'value' => $this->id,
        ];
    }
}
