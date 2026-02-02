<?php

namespace App\Domains\User\LocalizedDate;

use App\Models\User;
use Carbon\Factory;

readonly class UserCarbonFactory
{
    public static function forUser(?User $user): Factory
    {
        return new Factory([
            'locale' => $user ? $user->preferredLocale() : 'hu',
            'timezone' => $user ? $user->preferredTimezone() : 'GMT+1',
        ]);
    }
}
