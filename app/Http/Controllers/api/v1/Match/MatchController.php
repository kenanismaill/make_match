<?php

namespace App\Http\Controllers\api\v1\Match;

use App\Http\Controllers\Controller;
use App\Http\Resources\api\v1\Match\MatchResource;
use App\Models\Matches;
use App\Services\api\v1\Match\MatchService;
use App\Traits\api\v1\Enums\General\PaginateResourceTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MatchController extends Controller
{
    use PaginateResourceTrait;

    public function __construct(
        private readonly MatchService $matchService,
    )
    {
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        return $this
            ->paginateAndReturnResource(
                request: $request,
                model: Matches::class,
                resourceClass: MatchResource::class,
                relations: ['homeTeam', 'awayTeam']
            );
    }
}
