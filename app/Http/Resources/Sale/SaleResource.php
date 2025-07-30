<?php

namespace App\Http\Resources\Sale;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\SaleDetail\SaleDetailResource;

class SaleResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'sale_date' => $this->sale_date->format('Y-m-d'),
            'total' => (float) $this->total,
            'client_id' => $this->client_id,
            'client_name' => $this->whenLoaded('client', function () {
                return $this->client->name;
            }),
            'document_type_id' => $this->document_type_id,
            'document_type_name' => $this->whenLoaded('documentType', function () {
                return $this->documentType->name;
            }),
            'document_number' => $this->document_number,
            'customer_name' => $this->customer_name,
            'user_id' => $this->user_id,
            'user_name' => $this->whenLoaded('user', function () {
                return $this->user->name;
            }),
            'active' => (bool) $this->active,
            'user_created' => $this->user_created,
            'user_updated' => $this->user_updated,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
            'details' => SaleDetailResource::collection($this->whenLoaded('saleDetails')),
        ];
    }
}
