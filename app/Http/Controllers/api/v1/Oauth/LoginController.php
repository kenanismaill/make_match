<?php

namespace App\Http\Controllers\api\v1\Oauth;

use App\Exceptions\api\v1\UserException;
use App\Http\Controllers\Controller;
use App\Services\api\v1\Oauth\LoginService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct(
        private readonly LoginService $loginService
    )
    {}

    /**
     * Handle user login.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws UserException
     */
    public function login(Request $request): JsonResponse
    {
        $this->loginService->validateLoginRequest($request);

        $tokenData = $this->loginService->login($request);

        if ($tokenData) {
            return response()->json(['data' => $tokenData]);
        }

        return response()->json(['message' =>  __('login.invalid_credentials')], 404);
    }
}
