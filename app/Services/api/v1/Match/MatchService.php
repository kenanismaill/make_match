<?php

namespace App\Services\api\v1\Match;

use App\Exceptions\api\v1\ApiException;
use App\Http\Requests\api\v1\Match\StoreMatchRequest;
use App\Http\Requests\api\v1\Match\UpdateMatchRequest;
use App\Models\Matches;
use App\Models\MatchTeam;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MatchService
{

    /**
     * @throws ApiException
     */
    public function store(StoreMatchRequest $storeMatchRequest): Matches
    {
        /** @var User $user */
        $user = Auth::user();

        if (!$user->teams()->exists()) {
            throw new ApiException(10002);
        }

        if (!$user->ownTeams()->exists()) {
            throw new ApiException(10003);
        }
        DB::beginTransaction();
        try {
            /** @var Matches $match */
            $match = Matches::query()->create($storeMatchRequest->validated());
            MatchTeam::create([
                'match_id' => $match->id,
                'home_team' => $user->ownTeams()?->first()->id, //todo:: may check from request
                'away_team' => $storeMatchRequest->get('away_team_id'),
            ]);
            return $match;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::alert($e->getMessage());
            throw new ApiException(10001);
        }
    }

    public function update(UpdateMatchRequest $request, Matches $match): Matches
    {
        $data = $request->validated();
        $match->update($data);
        if (isset($data['away_team'])) {

        }
    }
}
