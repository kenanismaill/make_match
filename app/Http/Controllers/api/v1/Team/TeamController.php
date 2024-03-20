<?php

namespace App\Http\Controllers\api\v1\Team;

use App\Exceptions\api\v1\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\v1\Team\StoreTeamRequest;
use App\Http\Requests\api\v1\Team\UpdateTeamRequest;
use App\Http\Resources\api\v1\Team\TeamResource;
use App\Models\Team;
use App\Services\api\v1\Team\TeamService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class TeamController extends Controller
{
    public function __construct(
        private readonly TeamService $teamService
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $perPage = $request->input('per_page', 10);
        $page = $request->input('page', 1);

        $teams = Team::with('players:id,full_name')->paginate($perPage, ['*'], 'page', $page);
        return TeamResource::collection($teams);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeamRequest $request): Response
    {
        $this->teamService->store($request);
        return response()->noContent();
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team): TeamResource
    {
        return TeamResource::make($team->load(['players:id,full_name']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTeamRequest $request, Team $team): Response
    {
        $this->teamService->update(request: $request, team: $team);
        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     * @throws ApiException
     */
    public function destroy(Team $team): Response
    {
        $this->teamService->destroy(team: $team);
        return response()->noContent();
    }
}