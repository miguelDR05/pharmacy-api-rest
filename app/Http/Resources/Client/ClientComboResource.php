<?php

namespace App\Http\Resources\Client;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientComboResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'label' => $this->name . ' (' . $this->document_number . ')',
            'value' => $this->id,
        ];
    }
}
