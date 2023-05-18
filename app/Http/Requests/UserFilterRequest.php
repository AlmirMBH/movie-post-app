<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFilterRequest extends FormRequest
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
            'id' => 'nullable|integer',
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email',
            'role_id' => 'nullable|exists:roles,id',
            'registered_by' => 'nullable|exists:users,id',
            'movies' => 'nullable|boolean',
            'posts' => 'nullable|boolean',
            'favorites' => 'nullable|boolean'
        ];        
    }
}
