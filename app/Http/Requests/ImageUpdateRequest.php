<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageUpdateRequest extends FormRequest
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
            'model_name' => 'nullable|string|max:255',
            'model_id' => 'nullable|integer',
            'path' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'imageable_id' => 'nullable|integer',
            'imageable_name' => 'nullable|string|max:255',
        ];
    }
}
