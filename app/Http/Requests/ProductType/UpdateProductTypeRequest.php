<?php

namespace App\Http\Requests\ProductType;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;

class UpdateProductTypeRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        /** @var \Illuminate\Http\Request $this */
        $typeId = $this->route('product_type')->id;
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('product_types', 'name')->ignore($typeId)],
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
