<?php

namespace App\Http\Resources\api\v1\Oauth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RegisterResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'full_name' => $this->full_name,
            'email' => $this->email,
            'access_token' => $this->access_token,
        ];
    }
}
