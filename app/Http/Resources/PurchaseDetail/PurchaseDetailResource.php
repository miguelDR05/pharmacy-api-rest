<?php

namespace App\Http\Resources\PurchaseDetail;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Product\ProductResource;

class PurchaseDetailResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'purchase_id' => $this->purchase_id,
            'product_id' => $this->product_id,
            'product_name' => $this->whenLoaded('product', function () {
                return $this->product->name;
            }),
            'quantity' => (int) $this->quantity,
            'price' => (float) $this->price,
            'subtotal' => (float) $this->subtotal,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
