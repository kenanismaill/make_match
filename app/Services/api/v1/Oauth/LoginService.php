<?php

namespace App\Services\api\v1\Oauth;

use App\Enums\api\v1\UserType;
use App\Exceptions\api\v1\UserException;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class LoginService
{
    /**
     * Get the password client from the database.
     *
     * @return object|null
     */
    private function getPasswordClient(): ?object
    {
        return DB::table('oauth_clients')->where('password_client', 1)->first();
    }

    /**
     * Validate the login request.
     *
     * @param Request $request
     * @return void
     */
    public function validateLoginRequest(Request $request): void
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|max:100',
        ]);
    }

    /**
     * Handle user login and generate access token.
     *
     * @param Request $request
     * @return array|null
     * @throws UserException
     */
    public function login(Request $request): ?array
    {
        if (Auth::attempt($request->only('password', 'email'))) {
            /** @var User $user */
            $user = Auth::user();
            if (in_array($user->status, UserType::$invlaidUser)) {
                throw new UserException(10001);
            }
            return $this->generateAccessToken($request);
        }

        return null;
    }

    /**
     * Generate an access token using OAuth.
     *
     * @param Request $request
     * @return array|null
     */
    private function generateAccessToken(Request $request): ?array
    {
        $client = $this->getPasswordClient();

        if (!$client) {
            return null;
        }

        $request->request->add([
            'username' => $request->get('email'),
            'password' => $request->get('password'),
            'grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'scope' => '*'
        ]);

        $proxy = Request::create('oauth/token', 'POST');
        $response = Route::dispatch($proxy);

        return json_decode($response->getContent(), true);
    }
}

