<?php

namespace App\Middlewares;

use App\Models\User;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetUserLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        /** @var ?User $user */
        $user = Auth::guard('web')->user();

        if (! empty($user)) {
            app()->setLocale($user->preferredLocale());
        }

        return $next($request);
    }
}
