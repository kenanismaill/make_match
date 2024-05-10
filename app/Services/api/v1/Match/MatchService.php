<?php

namespace App\Services\api\v1\Match;

use App\Exceptions\api\v1\ApiException;
use App\Http\Requests\api\v1\Match\StoreMatchRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MatchService
{

    public function store(StoreMatchRequest $storeMatchRequest)
    {
        /** @var User $user */
        $user = Auth::user();
        if ($user->teams()->exists()) {
            throw new ApiException(30001);
        }
        return "ok";
    }
}
