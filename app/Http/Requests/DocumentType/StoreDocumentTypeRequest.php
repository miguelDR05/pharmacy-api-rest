<?php

namespace App\Http\Requests\DocumentType;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;

class StoreDocumentTypeRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:50', 'unique:document_types,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:document_types,code'],
            'active' => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre del tipo de documento es obligatorio.',
            'name.unique' => 'Ya existe un tipo de documento con este nombre.',
            'code.unique' => 'Ya existe un código para este tipo de documento.',
        ];
    }
}
