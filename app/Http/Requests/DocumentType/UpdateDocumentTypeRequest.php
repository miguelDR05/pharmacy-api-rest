<?php

namespace App\Http\Requests\DocumentType;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;

class UpdateDocumentTypeRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        /** @var \Illuminate\Http\Request $this */
        $documentTypeId = $this->route('document_type')->id;
        return [
            'name' => ['required', 'string', 'max:50', Rule::unique('document_types', 'name')->ignore($documentTypeId)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('document_types', 'code')->ignore($documentTypeId)],
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
