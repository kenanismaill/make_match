<?php

namespace App\Services\api\v1\Team;

use App\Exceptions\api\v1\ApiException;
use App\Http\Requests\api\v1\Team\StoreTeamRequest;
use App\Http\Requests\api\v1\Team\UpdateTeamRequest;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TeamService
{
    /**
     * create new team
     *
     * @param StoreTeamRequest $request
     * @return Team|void
     */
    public function store(StoreTeamRequest $request)
    {
        DB::beginTransaction();
        try {
            /** @var Team $team */
            $team = Team::query()->create($request->validated());
            if ($request->has('players')) {
                $team->players()->sync($request->get('players'));
            }

            DB::commit();

            return $team;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('team store error: ' . $e->getMessage());
        }

    }

    /**
     * @param UpdateTeamRequest $request
     * @param Team $team
     * @return Team|void
     */
    public function update(UpdateTeamRequest $request, Team $team)
    {
        DB::beginTransaction();
        try {
            $team->update($request->validated());
            if ($request->has('players')) {
                $team->players()->sync($request->get('players'));
            }

            DB::commit();

            return $team;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('team update error: ' . $e->getMessage());
        }
    }

    /**
     * @param Team $team
     * @return void
     * @throws ApiException
     */
    public function destroy(Team $team): void
    {
        // check if login user is the owner of the team
        /** @var User $loginUser */
        $loginUser = Auth::user();
        if (!$loginUser->teams()->where('team_id', $team->id)
            ->wherePivot('is_owner', true)->exists()
        ) {
            throw new ApiException(20001);
        }
        $team->players()->detach();
        $team->delete();
    }
}
