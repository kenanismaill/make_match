<?php

namespace App\Exceptions\api\v1;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;;

class UserExceptionHandler extends ExceptionHandler
{
    public static function handle(UserException $e): JsonResponse
    {
        $errorCode = $e->getErrorCode();
        $errorData = Config::get("errorCodes.$errorCode");

        if ($errorData) {
            $errorMessage = Lang::get($errorData['message']);
            $errorCode = $errorData['code'];

            return response()->json([
                'code' => $errorCode,
                'message' => $errorMessage,
            ], 500);
        }
        return response()->json([
            'code' => 500,
            'message' => __('general.unknown_error'),
        ], 500);
    }
}
