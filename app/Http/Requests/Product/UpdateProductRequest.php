<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        /** @var \Illuminate\Http\Request $this */
        $productId = $this->route('product')->id;
        return [
            // Valida que el ID del producto en la ruta exista en la tabla 'products'
            // 'product' => ['required', 'integer', 'exists:products,id'], // ¡Añade esta línea!
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255', Rule::unique('products', 'code')->ignore($productId)],
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
            // Si el campo 'image' está presente en la solicitud, DEBE ser una imagen válida.
            // Si no está presente, la validación se ignora para este campo.
            'image' => ['sometimes', 'image', 'max:2048'],
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
        ];
    }
}
