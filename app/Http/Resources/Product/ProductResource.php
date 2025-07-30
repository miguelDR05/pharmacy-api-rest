<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage; // Importa Storage

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        // Define la URL base de tu aplicación
        // En producción, esto debería ser tu dominio (ej. 'https://tudominio.com')
        // En desarrollo, 'http://localhost:8000' o la URL que uses.
        $appUrl = config('app.url');

        $relativePath = $this->image ? Storage::url($this->image) : null;

        // Construir la URL completa
        $fullImageUrl = null;
        if ($relativePath) {
            $fullImageUrl = rtrim($appUrl, '/') . $relativePath;
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'description' => $this->description,
            'batch' => $this->batch,
            'image' => $this->image,
            'concentration' => $this->concentration,
            'pharmaceutical_form' => $this->pharmaceutical_form,
            'administration_route' => $this->administration_route,
            'stock' => (int) $this->stock,
            'price' => (float) $this->price,
            'expiration_date' => $this->expiration_date ? $this->expiration_date->format('Y-m-d') : null,
            'batch' => $this->batch,
            'category_id' => $this->category_id,
            'category_name' => $this->whenLoaded('category', function () {
                return $this->category->name;
            }),
            'lab_id' => $this->lab_id,
            'lab_name' => $this->whenLoaded('lab', function () {
                return $this->lab->name;
            }),
            'type_id' => $this->type_id,
            'type_name' => $this->whenLoaded('type', function () {
                return $this->type->name;
            }),
            'presentation_id' => $this->presentation_id,
            'presentation_name' => $this->whenLoaded('presentation', function () {
                return $this->presentation->name;
            }),
            'pharmaceutical_form' => $this->pharmaceutical_form,
            'min_stock' => (int) $this->min_stock,
            'manufacturing_date' => $this->manufacturing_date ? $this->manufacturing_date->format('Y-m-d') : null,
            'requires_prescription' => (bool) $this->requires_prescription,
            'is_controlled' => (bool) $this->is_controlled,
            // --- CAMBIO AQUÍ: storage_condition_id y storage_condition_label ---
            'storage_condition_id' => $this->storage_condition_id,
            'storage_condition_label' => $this->whenLoaded('storageCondition', function () {
                return $this->storageCondition->label;
            }),
            'image' => $fullImageUrl,
            // status
        ];
    }
}
