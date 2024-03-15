<?php

namespace App\Services\api\v1\Oauth;

use App\Http\Requests\api\v1\Oauth\RegisterRequest;
use App\Jobs\api\v1\register\WelcomeEmailJob;
use App\Models\Address;
use App\Models\Profile;
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
            $user = User::create($userData);

            if ($user) {
                $profileData = $request->get('profile', []);
                $profile = new Profile($profileData);
                $user->profile()->save($profile);

                $addressData = $request->get('address', []);
                $address = new Address($addressData);
                $user->addresses()->save($address);

                $tokenData = $user->createToken('authentication')->accessToken;
                $user->access_token = $tokenData;
                WelcomeEmailJob::dispatch($user);
                DB::commit();
                return $user;
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error(trans('log.registration_error') . $e->getMessage());
        }

        return null;
    }
}
