<?php

namespace App\Http\Requests\api\v1\Match;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateMatchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    protected $stopOnFirstFailure = true;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'location' => [
                'required',
                'string',
                'max:255',
            ],
            'start_date' => [
                'required',
                'date_format:Y-m-d H:i:s'
            ],
            'away_team_id' => [
                Rule::exists(table: 'teams', column: 'id')
            ]
        ];
    }


    /**
     * Get custom validation messages.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'location.required' => trans('validation.required'),
            'location.string' => trans('validation.string'),
            'location.max' => trans('validation.max.string', ['max' => ':max']),
            'start_date.required' => trans('validation.required'),
            'start_date.date_format' => trans('validation.date_format', ['format' => 'Y-m-d H:i:s']),
            'away_team_id.exists' => trans('validation.exists', ['attribute' => trans('team.id')])
        ];
    }
}
