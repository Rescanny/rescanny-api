<?php

namespace App\Providers;

use App\Domains\Auth\Listeners\SetLoginDate;
use App\Domains\User\Events\UserDeleted;
use App\Domains\User\Listeners\NotifyUserAboutDeletedAccount;
use Illuminate\Auth\Events\Login;

class EventServiceProvider extends \Illuminate\Foundation\Support\Providers\EventServiceProvider
{
    protected $listen = [
        Login::class => [
            SetLoginDate::class,
        ],
        UserDeleted::class => [
            NotifyUserAboutDeletedAccount::class,
        ],
    ];
}
