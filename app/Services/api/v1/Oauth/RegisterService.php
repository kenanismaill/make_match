<?php

namespace App\Services\api\v1\Oauth;

use App\Http\Requests\api\v1\Oauth\RegisterRequest;
use App\Jobs\api\v1\register\WelcomeEmailJob;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterService
{

    public function register(RegisterRequest $request): User
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $data['remember_token'] = Str::random(10);

        /** @var User $user */
        $user = User::query()->create($data);
        if ($user) {
            Auth::login($user);
            $tokenData = $user->createToken('authentication')->accessToken;
            $user->access_token = $tokenData;
            WelcomeEmailJob::dispatch($user);
            return $user;
        }
    }
}
