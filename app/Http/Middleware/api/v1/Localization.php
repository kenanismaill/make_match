<?php

namespace App\Http\Middleware\api\v1;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class Localization
{
    public function handle(Request $request, Closure $next): Response
    {
        App::setLocale($request->header('Accept-Language') ?? 'en');
        return $next($request);
    }
}
