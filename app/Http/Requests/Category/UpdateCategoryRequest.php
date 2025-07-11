<?php

namespace App\Http\Requests\Category;

use App\Http\Requests\BaseFormRequest;

class UpdateCategoryRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            // 'description' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre de la categoría es obligatorio.',
        ];
    }
}
