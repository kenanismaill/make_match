<?php

namespace App\Http\Controllers\api\v1\Oauth;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\v1\Oauth\RegisterRequest;
use App\Http\Resources\api\v1\Oauth\RegisterResource;
use App\Services\api\v1\Oauth\RegisterService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    public function __construct(
        private readonly RegisterService $registerService
    )
    {
    }

    public function register(RegisterRequest $request): RegisterResource
    {
        $user  = $this->registerService->register($request);
        return RegisterResource::make($user);
    }
}
