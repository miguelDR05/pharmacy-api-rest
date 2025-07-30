<?php

namespace App\Http\Requests\Supplier;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;

class UpdateSupplierRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        /** @var \Illuminate\Http\Request $this */
        $supplierId = $this->route('supplier')->id;
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('suppliers', 'name')->ignore($supplierId)],
            'ruc' => ['nullable', 'string', 'max:11', Rule::unique('suppliers', 'ruc')->ignore($supplierId)],
            'address' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255', Rule::unique('suppliers', 'email')->ignore($supplierId)],
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
