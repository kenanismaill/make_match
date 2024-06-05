<?php

namespace App\Http\Requests\api\v1\Oauth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected $stopOnFirstFailure = true;

    public function rules(): array
    {
        return [
            'full_name' => [
                'required',
                'string',
                'max:255',
                'min:5',
            ],
            'email' => [
                'required',
                'string',
                'email',
                Rule::unique('users', 'email'),
            ],
            'password' => [
                'required',
                'string',
                'min:5',
                'confirmed',
            ],
            'phone_number' => [
                'required',
                'string',
                'regex:/^\+[0-9]{7,15}$/'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'full_name.required' => trans('validation.required', ['attribute' => 'full name']),
            'full_name.string' => trans('validation.string', ['attribute' => 'full name']),
            'full_name.max' => trans('validation.max.string', ['attribute' => 'full name', 'max' => 255]),
            'full_name.min' => trans('validation.min.string', ['attribute' => 'full name', 'min' => 5]),

            'email.required' => trans('validation.required', ['attribute' => 'email']),
            'email.string' => trans('validation.string', ['attribute' => 'email']),
            'email.email' => trans('validation.email', ['attribute' => 'email']),
            'email.unique' => trans('validation.unique', ['attribute' => 'email']),

            'password.required' => trans('validation.required', ['attribute' => 'password']),
            'password.string' => trans('validation.string', ['attribute' => 'password']),
            'password.min' => trans('validation.min.string', ['attribute' => 'password', 'min' => 5]),
            'password.confirmed' => trans('validation.confirmed', ['attribute' => 'password']),

            'phone_number.required' => trans('validation.required', ['attribute' => 'phone number']),
            'phone_number.string' => trans('validation.string', ['attribute' => 'phone number']),
            'phone_number.regex' => trans('validation.regex', ['attribute' => 'phone number']),
        ];
    }
}
