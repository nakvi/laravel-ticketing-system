<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
        ];
    }

    /**
     * Custom error messages (optional but recommended)
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The category name is required.',
            'name.unique'   => 'This category name already exists.',
            'name.max'      => 'Category name cannot be longer than 255 characters.',
        ];
    }
}