<?php

namespace App\Http\Requests\api\v1\Team;

use App\Enums\api\v1\Team\TeamType;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateTeamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): ?Authenticatable
    {
        return Auth::user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'nullable',
                'max:255',
                'min:2',
            ],
            'type' => [
                'nullable',
                Rule::in(TeamType::cases())
            ],
            'players' => [
                'array',
                'nullable',
            ],
            'players.*' => [
                Rule::exists('users','id')
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'required' => trans('validation.required'),
            'string' => trans('validation.string'),
            'max' => trans('validation.max.string', ['max' => ':max']),
            'min' => trans('validation.min.string', ['min' => ':min']),
            'type.in' => trans('validation.in', ['attribute' => trans('team.type')]),
            'players.array' => trans('validation.array', ['attribute' => trans('team.players')]),
            'players.*.exists' => trans('validation.exists', ['attribute' => trans('team.player')]),
        ];
    }
}
