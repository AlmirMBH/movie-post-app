<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostUpdateRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'body' => 'nullable|string',
            'author_id' => 'nullable|exists:users,id',
            'category_id' => 'nullable|exists:categories,id',
            'slug' => 'nullable|string|unique:posts|max:255',
            'added_by_id' => 'nullable|exists:users,id',
            'subtitle' => 'nullable|string',
        ];
    }
}
