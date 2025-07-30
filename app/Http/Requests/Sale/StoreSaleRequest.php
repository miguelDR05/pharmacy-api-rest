<?php

namespace App\Http\Requests\Sale;

use App\Http\Requests\BaseFormRequest;

class StoreSaleRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'sale_date' => ['required', 'date'],
            'total' => ['required', 'numeric', 'min:0'],
            'client_id' => ['nullable', 'exists:clients,id'],
            'document_type_id' => ['nullable', 'exists:document_types,id'],
            'document_number' => ['nullable', 'string', 'max:15'],
            'customer_name' => ['nullable', 'string', 'max:255'],
            'active' => ['boolean'],
            // Validaciones para los detalles de venta
            'details' => ['required', 'array', 'min:1'],
            'details.*.product_id' => ['required', 'exists:products,id'],
            'details.*.quantity' => ['required', 'integer', 'min:1'],
            'details.*.price' => ['required', 'numeric', 'min:0'],
            'details.*.subtotal' => ['required', 'numeric', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'sale_date.required' => 'La fecha de venta es obligatoria.',
            'total.required' => 'El total de la venta es obligatorio.',
            'client_id.exists' => 'El cliente seleccionado no existe.',
            'document_type_id.exists' => 'El tipo de documento seleccionado no existe.',
            'details.required' => 'Debe haber al menos un detalle de venta.',
            'details.array' => 'Los detalles de venta deben ser un array.',
            'details.*.product_id.required' => 'El producto es obligatorio en cada detalle.',
            'details.*.product_id.exists' => 'El producto seleccionado en un detalle no existe.',
            'details.*.quantity.required' => 'La cantidad es obligatoria en cada detalle.',
            'details.*.quantity.integer' => 'La cantidad debe ser un número entero.',
            'details.*.price.required' => 'El precio es obligatorio en cada detalle.',
            'details.*.subtotal.required' => 'El subtotal es obligatorio en cada detalle.',
        ];
    }
}
