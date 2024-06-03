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
                Rule::unique('users', 'email'),
                'email',
            ],
            'password' => [
                'required',
                'string',
                'min:5',
                'confirmed',
            ],
            'profile' => [
                'required',
                'array',
            ],
            'profile.photo' => [
                'nullable',
                'url',
            ],
            'profile.birth_date' => [
                'required',
                'date',
                'before_or_equal:' . now()->subYears(15)->format('Y-m-d'),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => trans('validation.required'),
            'string' => trans('validation.string'),
            'max' => [
                'string' => trans('validation.max.string', ['max' => ':max']),
            ],
            'min' => [
                'string' => trans('validation.min.string', ['min' => ':min']),
            ],
            'email' => trans('validation.email'),
            'unique' => trans('validation.unique'),
            'url' => trans('validation.url'),
            'date' => trans('validation.date'),
            'before_or_equal' => trans('validation.before_or_equal'),
            'confirmed' => trans('validation.confirmed'),
            'array' => trans('validation.array'),
        ];
    }
}
