<?php

namespace App\Http\Requests\ProductPresentation;

use App\Http\Requests\BaseFormRequest;

class StoreProductPresentationRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:product_presentations,name'],
            'active' => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre de la presentación es obligatorio.',
            'name.unique' => 'Ya existe una presentación con este nombre.',
            'name.max' => 'El nombre no puede exceder los 255 caracteres.',
            'active.boolean' => 'El campo activo debe ser un valor booleano.',
        ];
    }
}
