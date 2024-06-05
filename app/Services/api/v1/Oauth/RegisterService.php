<?php

namespace App\Services\api\v1\Oauth;

use App\Http\Requests\api\v1\Oauth\RegisterRequest;
use App\Jobs\api\v1\register\WelcomeEmailJob;
use App\Models\Address;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class RegisterService
{
    /**
     * Register a new user.
     *
     * @param RegisterRequest $request
     * @return User|null
     */
    public function register(RegisterRequest $request): ?User
    {
        DB::beginTransaction();
        try {
            $userData = $request->validated();
            $userData['password'] = Hash::make($userData['password']);

            /** @var User $user */
            $user = User::query()->create($userData);

            if ($user) {
                $tokenData = $user->createToken('authentication')->accessToken;
                $user->access_token = $tokenData;
                WelcomeEmailJob::dispatch($user);
                DB::commit();
                return $user;
            }
            return null;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error(trans('log.registration_error') . $e->getMessage());
        }
        return null;
    }
}
