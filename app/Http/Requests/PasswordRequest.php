<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class PasswordRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'current_password'=>'required',
            'password'=>['required','confirmed',Password::min(8)
            ->letters()
            ->mixedCase()
            ->numbers()
            ->symbols()
        ],
            'password_confirmation'=>'required',
        ];
    }
    public function messages(): array
    {
        return [
            'current_password.required'=>'Please Enter Current Password!',
            'password.required'=>'Please Enter New Password!',
            'password_confirmation.required'=>'Please Enter Confirm Password!',
        ];
    }
}
