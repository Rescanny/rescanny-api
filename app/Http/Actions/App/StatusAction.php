<?php

namespace App\Http\Actions\App;

use App\Domains\AppStatus\AppStatus;
use App\Models\MaintenanceMode;
use Illuminate\Http\JsonResponse;

class StatusAction
{
    public function __invoke(): JsonResponse
    {
        return response()->json([
            'version' => AppStatus::get(),
            'time' => now(),
            'maintenance' => MaintenanceMode::current()?->toResource(),
        ]);
    }
}
