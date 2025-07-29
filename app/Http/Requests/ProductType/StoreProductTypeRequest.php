<?php

namespace App\Http\Requests\ProductType;

use App\Http\Requests\BaseFormRequest;

class StoreProductTypeRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:product_types,name'],
            'active' => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre del tipo de producto es obligatorio.',
            'name.unique' => 'Ya existe un tipo de producto con este nombre.',
            'name.max' => 'El nombre no puede exceder los 255 caracteres.',
            'active.boolean' => 'El campo activo debe ser un valor booleano.',
        ];
    }
}
