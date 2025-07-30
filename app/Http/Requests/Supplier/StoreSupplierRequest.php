<?php

namespace App\Http\Requests\Supplier;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;

class StoreSupplierRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:suppliers,name'],
            'ruc' => ['nullable', 'string', 'max:11', 'unique:suppliers,ruc'],
            'address' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:suppliers,email'],
            'active' => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre del proveedor es obligatorio.',
            'name.unique' => 'Ya existe un proveedor con este nombre.',
            'ruc.unique' => 'Este RUC ya está registrado para otro proveedor.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
        ];
    }
}
