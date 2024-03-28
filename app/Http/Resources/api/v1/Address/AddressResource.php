<?php

namespace App\Http\Resources\api\v1\Address;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'full_address' => $this->fullAddress,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ];
    }
}
