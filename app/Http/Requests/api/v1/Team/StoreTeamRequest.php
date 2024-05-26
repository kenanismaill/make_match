<?php

namespace App\Http\Requests\api\v1\Team;

use App\Enums\api\v1\Team\TeamType;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreTeamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): Authenticatable
    {
        return Auth::user();
    }

    protected $stopOnFirstFailure = true;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'max:255',
                'min:1',
            ],
            'size' => [
                'nullable',
                'numeric',
                'min:1',
                'max:25',
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
            'size.numeric' => trans('validation.numeric', ['attribute' => trans('team.size')]),
            'size.min' => trans('validation.min.numeric', ['min' => 1]),
            'size.max' => trans('validation.max.numeric', ['max' => 25]),
            'players.array' => trans('validation.array', ['attribute' => trans('team.players')]),
            'players.*.exists' => trans('validation.exists', ['attribute' => trans('team.player')]),
        ];
    }
}
