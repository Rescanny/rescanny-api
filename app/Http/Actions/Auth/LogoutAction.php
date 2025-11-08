<?php

namespace App\Http\Actions\Auth;

use Symfony\Component\HttpFoundation\Response;

class LogoutAction
{
    public function __invoke(): Response
    {
        \Auth::logout();

        return response()->json(['message' => __('auth.logout')]);
    }
}
