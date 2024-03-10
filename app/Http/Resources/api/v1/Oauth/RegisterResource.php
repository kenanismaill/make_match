<?php

namespace App\Http\Resources\api\v1\Oauth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RegisterResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'profile_photo' => $this->profile_photo,
            'birth_date' => $this->birth_date,
            'access_token' => $this->access_token,
        ];
    }
}
