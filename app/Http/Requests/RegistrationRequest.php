<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
            'name' => 'required|string|min:2|max:50',
            'surname' => 'required|string|min:2|max:50',
            'email' => 'required|unique:users|string|email|max:255',
            'password' => 'required|string|min:8|max:16',
            'description' => 'nullable|string|min:10|max:255',
            'image' => 'required|image|mimes:png,jpg'
        ];
    }
}
