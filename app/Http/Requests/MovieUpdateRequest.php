<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieUpdateRequest extends FormRequest
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
            'body' => 'nullable|string',
            'image_id' => 'nullable|exists:images,id',
            'director' => 'nullable|string|max:255',
            'slug' => 'nullable|string|unique:movies|max:255',
            'added_by_id' => 'nullable|exists:users,id',
        ];
    }
}
