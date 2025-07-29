<?php

namespace App\Http\Requests\Lab;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;

class UpdateLabRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        /** @var \Illuminate\Http\Request $this */
        $labId = $this->route('lab')->id;
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('labs', 'name')->ignore($labId)],
            'active' => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre del laboratorio es obligatorio.',
            'name.unique' => 'Ya existe un laboratorio con este nombre.',
            'name.max' => 'El nombre no puede exceder los 255 caracteres.',
            'active.boolean' => 'El campo activo debe ser un valor booleano.',
        ];
    }
}
