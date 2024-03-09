<?php

namespace App\Http\Middleware\api\v1;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Localization
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->header('Accept-Language') ?? config('app.locale');
        app()->setLocale(locale: $locale);
        return $next($request);
    }
}
