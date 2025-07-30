<?php

namespace App\Http\Requests\StorageCondition;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;

class StoreStorageConditionRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'label' => ['required', 'string', 'max:255', 'unique:storage_conditions,label'],
            'value' => ['required', 'string', 'max:255', 'unique:storage_conditions,value'],
            'active' => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'label.required' => 'La etiqueta de la condición de almacenamiento es obligatoria.',
            'label.unique' => 'Ya existe una condición de almacenamiento con esta etiqueta.',
            'label.max' => 'La etiqueta no puede exceder los 255 caracteres.',
            'value.required' => 'El valor de la condición de almacenamiento es obligatorio.',
            'value.unique' => 'Ya existe una condición de almacenamiento con este valor.',
            'value.max' => 'El valor no puede exceder los 255 caracteres.',
            'active.boolean' => 'El campo activo debe ser un valor booleano.',
        ];
    }
}
