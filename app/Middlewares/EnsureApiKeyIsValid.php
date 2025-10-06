<?php

namespace App\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureApiKeyIsValid
{
    public function handle(Request $request, Closure $next): Response
    {
        if (
            empty($request->bearerToken()) ||
            ! hash_equals(config('auth.master_api_key'), $request->bearerToken())
        ) {
            return response(content: null, status: 401);
        }

        return $next($request);
    }
}
