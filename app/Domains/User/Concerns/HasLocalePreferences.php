<?php

namespace App\Domains\User\Concerns;

use App\Domains\User\LocalizedDate\UserCarbonFactory;
use Carbon\Factory;

trait HasLocalePreferences
{
    public function preferredLocale(): string
    {
        return $this->locale;
    }

    public function preferredTimezone(): string
    {
        return $this->timezone;
    }

    public function carbonFactory(): Factory
    {
        return UserCarbonFactory::forUser($this);
    }
}
