<?php

namespace App\Http\Requests\ProductPresentation;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;

class UpdateProductPresentationRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        /** @var \Illuminate\Http\Request $this */
        $presentationId = $this->route('product_presentation')->id;
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('product_presentations', 'name')->ignore($presentationId)],
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
