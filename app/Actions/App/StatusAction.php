<?php

namespace App\Actions\App;

use App\Domains\AppStatus\AppStatus;
use Illuminate\Http\JsonResponse;

class StatusAction
{
    public function __invoke(): JsonResponse
    {
        return response()->json([
            'ready' => true,
            'version' => AppStatus::get(),
            'time' => now(),
        ]);
    }
}
