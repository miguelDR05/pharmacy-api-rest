<?php

namespace App\Http\Resources\Purchase;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\PurchaseDetail\PurchaseDetailResource;

class PurchaseResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'purchase_date' => $this->purchase_date->format('Y-m-d'),
            'total' => (float) $this->total,
            'supplier_id' => $this->supplier_id,
            'supplier_name' => $this->whenLoaded('supplier', function () {
                return $this->supplier->name;
            }),
            'purchase_document_type_id' => $this->purchase_document_type_id,
            'purchase_document_type_name' => $this->whenLoaded('purchaseDocumentType', function () {
                return $this->purchaseDocumentType->name;
            }),
            'document_number' => $this->document_number,
            'user_id' => $this->user_id,
            'user_name' => $this->whenLoaded('user', function () {
                return $this->user->name;
            }),
            'active' => (bool) $this->active,
            'user_created' => $this->user_created,
            'user_updated' => $this->user_updated,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
            'details' => PurchaseDetailResource::collection($this->whenLoaded('purchaseDetails')),
        ];
    }
}
