<?php

namespace App\Http\Requests\Client;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;

class StoreClientRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'document_type_id' => ['nullable', 'exists:document_types,id'],
            'document_number' => ['nullable', 'string', 'max:15', 'unique:clients,document_number'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:clients,email'],
            'phone' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'active' => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'document_type_id.exists' => 'El tipo de documento seleccionado no existe.',
            'document_number.unique' => 'Este número de documento ya está registrado.',
            'name.required' => 'El nombre del cliente es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
        ];
    }
}
