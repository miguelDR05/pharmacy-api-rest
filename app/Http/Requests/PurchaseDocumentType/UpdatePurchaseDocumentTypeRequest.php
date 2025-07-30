<?php

namespace App\Http\Requests\PurchaseDocumentType;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;

class UpdatePurchaseDocumentTypeRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        /** @var \Illuminate\Http\Request $this */
        $purchaseDocumentTypeId = $this->route('purchase_document_type')->id;
        return [
            'name' => ['required', 'string', 'max:50', Rule::unique('purchase_document_types', 'name')->ignore($purchaseDocumentTypeId)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('purchase_document_types', 'code')->ignore($purchaseDocumentTypeId)],
            'active' => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre del tipo de documento de compra es obligatorio.',
            'name.unique' => 'Ya existe un tipo de documento de compra con este nombre.',
            'code.unique' => 'Ya existe un código para este tipo de documento de compra.',
        ];
    }
}
