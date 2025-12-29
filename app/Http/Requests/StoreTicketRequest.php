<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTicketRequest extends FormRequest
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
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'priority'    => 'required|in:low,medium,high',
            'images.*'    => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120', // Each image max 5MB
            'images'      => 'nullable|array|max:10', // Max 10 images
        ];
    }

    /**
     * Custom error messages (optional but recommended)
     */
    public function messages(): array
    {
        return [
            'title.required'       => 'Please enter a title for the ticket.',
            'description.required' => 'Please provide a description.',
            'category_id.required' => 'Please select a category.',
            'category_id.exists'   => 'The selected category does not exist.',
            'priority.required'    => 'Please select a priority level.',
            'images.*.image' => 'Each file must be an image.',
            'images.*.mimes' => 'Only JPEG, PNG, JPG, GIF, WEBP files are allowed.',
            'images.*.max'   => 'Each image may not be greater than 5MB.',
            'images.max'     => 'You can upload a maximum of 10 images.',
        ];
    }
}
