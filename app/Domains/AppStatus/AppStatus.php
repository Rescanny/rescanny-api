<?php

namespace App\Domains\AppStatus;

readonly class AppStatus
{
    public static function get(): ?string
    {
        if (! file_exists(base_path('VERSION'))) {
            return 'Unknown';
        }

        $version = file_get_contents(base_path('VERSION'));

        if (empty($version)) {
            return 'Unknown';
        }

        return trim($version);
    }
}
