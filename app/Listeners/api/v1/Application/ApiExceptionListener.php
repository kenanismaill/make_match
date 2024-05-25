<?php

namespace App\Listeners\api\v1\Application;

use App\Events\api\v1\Application\ApiExceptionEvent;
use App\Exceptions\api\v1\ApiException;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class ApiExceptionListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle($event): void
    {
        $exception = $event->exception;
        Log::error('API Exception occurred: '.
            $exception->getMessage() . ' with error code: '.
            $exception->getErrorCode());
    }
}
