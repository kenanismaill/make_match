<?php

namespace App\Exceptions;

use App\Events\api\v1\Application\ApiExceptionEvent;
use App\Exceptions\api\v1\ApiException;
use App\Exceptions\api\v1\ApiExceptionHandler;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * @return void
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * @param $request
     * @param Throwable $e
     * @return JsonResponse|\Symfony\Component\HttpFoundation\Response|void
     */
    public function render($request, Throwable $e)
    {
        event(new ApiExceptionEvent($e));
        if ($e instanceof ApiException) {
            return ApiExceptionHandler::handle($e);
        }
//        return parent::render($request, $e);
    }
}
