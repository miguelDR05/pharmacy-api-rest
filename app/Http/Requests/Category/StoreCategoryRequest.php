<?php


namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'active' => 'boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre de la categoría es obligatorio.',
        ];
    }
}
