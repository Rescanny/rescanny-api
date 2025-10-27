<?php

namespace App\Domains\Auth\Listeners;

use App\Models\User;
use Illuminate\Auth\Events\Login;

class SetLoginDate
{
    public function __invoke(Login $event): void
    {
        /** @var User $user */
        $user = $event->user;

        $user->last_login = now();
        $user->save();
    }
}
