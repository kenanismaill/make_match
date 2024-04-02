<?php

namespace App\Http\Resources\api\v1\Stadium;

use App\Http\Resources\api\v1\Address\AddressResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StadiumResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'capacity' => $this->capacity,
            'status' => $this->status,
            'location' => $this->location,
            'description' => $this->description,
            'contact_number' => $this->contact_number,
            'email' => $this->email,
            'website' => $this->website,
            'owner' => $this->owner,
            'surface_type' => $this->surface_type,
            'opening_time' => $this->opening_time,
            'closing_time' => $this->closing_time,
            'architect' => $this->architect,
            'seating_details' => $this->seating_details,
            'amenities' => $this->amenities,
            'accessibility_features' => $this->accessibility_features,
            'social_media_links' => $this->social_media_links,
            'address' => $this->whenLoaded('address', function () {
                return AddressResource::make($this->address);
            })
        ];
    }
}
