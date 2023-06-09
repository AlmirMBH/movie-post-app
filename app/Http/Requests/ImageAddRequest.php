<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageAddRequest extends FormRequest
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
            'model_name' => 'required|string|max:255',
            'model_id' => 'required|integer',
            'path' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'imageable_id' => 'required|integer',
            'imageable_name' => 'required|string|max:255',            
        ];
    }
}
