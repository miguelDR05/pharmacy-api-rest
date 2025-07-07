<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255', Rule::unique('products', 'code')->ignore($this->product)],
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
    }
}
