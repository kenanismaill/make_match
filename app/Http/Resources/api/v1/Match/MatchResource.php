<?php

namespace App\Http\Resources\api\v1\Match;

use App\Enums\api\v1\Matches\MatchStatus;
use App\Http\Resources\api\v1\Team\TeamResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MatchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'status' => MatchStatus::label($this->status),
            'start_date' => $this->start_date,
            'location' => $this->location,
            'result' => $this->result,
            'home_team' => $this->whenLoaded('homeTeam', function () {
                return TeamResource::make($this->homeTeam);
            }),
            'away_team' => $this->whenLoaded('awayTeam', function () {
                return TeamResource::make($this->awayTeam);
            })
        ];
    }
}
