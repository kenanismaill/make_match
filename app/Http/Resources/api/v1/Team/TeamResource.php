<?php

namespace App\Http\Resources\api\v1\Team;

use App\Enums\api\v1\Team\TeamType;
use App\Http\Resources\api\v1\Match\MatchResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends JsonResource
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
            'name' => $this->name,
            'type' => $this->type->name,
            'capacity' => TeamType::capacity(type: $this->type),
            'players_count' => $this->whenLoaded('players', function (){
                return $this->players->count();
            }),
            'players' => $this->whenLoaded('players', function () {
                return $this->players->map(function ($player) {
                    $playerInfos = [
                        'id' => $player->id,
                        'full_name' => $player->full_name,
                        'is_owner' => $player->pivot->is_owner
                    ];

                    if ($player->relationLoaded('profile')) {
                        $playerInfos['profile'] = $player->profile;
                    }

                    return $playerInfos;
                });
            }),
            'home_matches' => $this->whenLoaded('homeMatches', function () {
                return MatchResource::collection($this->homeMatches);
            }),
            'away_matches' => $this->whenLoaded('awayMatches', function () {
                return MatchResource::collection($this->awayMatches);
            }),
        ];
    }
}
