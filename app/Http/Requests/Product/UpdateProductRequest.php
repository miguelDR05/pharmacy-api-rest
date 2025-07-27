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
            'image' => ['nullable', 'image', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return (new StoreProductRequest)->messages();

        // return array_merge((new StoreProductRequest)->messages(), [
        //     'product.required' => 'El ID del producto es requerido.',
        //     'product.integer' => 'El ID del producto debe ser un número entero.',
        //     'product.exists' => 'El producto especificado no existe.',
        // ]);
    }
}
