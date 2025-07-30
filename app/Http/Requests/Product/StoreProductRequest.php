<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255', 'unique:products,code'],
            'description' => ['nullable', 'string'],
            'concentration' => ['nullable', 'string', 'max:255'],
            'pharmaceutical_form' => ['required', 'string', 'max:255'],
            'administration_route' => ['nullable', 'string', 'max:255'],
            'stock' => ['required', 'integer', 'min:0'],
            'price' => ['required', 'numeric', 'min:0'],
            'expiration_date' => ['nullable', 'date'],
            'batch' => ['nullable', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'lab_id' => ['required', 'exists:labs,id'],
            'type_id' => ['required', 'exists:product_types,id'],
            'presentation_id' => ['required', 'exists:product_presentations,id'],
            'image' => ['nullable', 'image', 'max:2048'],
            'active' => ['boolean'],
            'min_stock' => ['required', 'integer', 'min:0'],
            'manufacturing_date' => ['nullable', 'date'],
            'requires_prescription' => ['boolean'],
            'is_controlled' => ['boolean'],
            'storage_condition_id' => ['nullable', 'exists:storage_conditions,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre del producto es obligatorio.',
            'name.max' => 'El nombre no puede exceder 255 caracteres.',
            'code.required' => 'El código del producto es obligatorio.',
            'code.unique' => 'Este código ya está registrado.',
            'code.max' => 'El código no puede exceder 255 caracteres.',
            'pharmaceutical_form.required' => 'La forma farmacéutica es obligatoria.',
            'pharmaceutical_form.max' => 'La forma farmacéutica no puede exceder 255 caracteres.',
            'price.required' => 'El precio es obligatorio.',
            'price.numeric' => 'El precio debe ser un número.',
            'price.min' => 'El precio no puede ser negativo.',
            'stock.required' => 'El stock es obligatorio.',
            'stock.integer' => 'El stock debe ser un número entero.',
            'stock.min' => 'El stock no puede ser negativo.',
            'expiration_date.date' => 'La fecha de expiración debe ser una fecha válida.',
            'category_id.required' => 'Debe seleccionar una categoría.',
            'category_id.exists' => 'La categoría seleccionada no existe.',
            'lab_id.required' => 'Debe seleccionar un laboratorio.',
            'lab_id.exists' => 'El laboratorio seleccionado no existe.',
            'type_id.required' => 'Debe seleccionar un tipo de producto.',
            'type_id.exists' => 'El tipo de producto seleccionado no existe.',
            'presentation_id.required' => 'Debe seleccionar una presentación.',
            'presentation_id.exists' => 'La presentación seleccionada no existe.',
            'image.image' => 'El archivo debe ser una imagen válida.',
            'image.max' => 'La imagen no puede pesar más de 2MB.',
            'active.boolean' => 'El campo activo debe ser un valor booleano.',
            'min_stock.required' => 'El stock mínimo es obligatorio.',
            'min_stock.integer' => 'El stock mínimo debe ser un número entero.',
            'min_stock.min' => 'El stock mínimo no puede ser negativo.',
            'manufacturing_date.date' => 'La fecha de fabricación debe ser una fecha válida.',
            'requires_prescription.boolean' => 'El campo "requiere receta" debe ser un valor booleano.',
            'is_controlled.boolean' => 'El campo "es controlado" debe ser un valor booleano.',
            // --- NUEVOS MENSAJES DE VALIDACIÓN ---
            'storage_condition_id.exists' => 'La condición de almacenamiento seleccionada no existe.',
        ];
    }
}
