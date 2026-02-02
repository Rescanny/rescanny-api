<?php

namespace App\Http\Resources;

use App\Domains\User\LocalizedDate\UserCarbonFactory;
use App\Models\MaintenanceMode;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin MaintenanceMode
 */
class MaintenanceModeResource extends JsonResource
{
    public function __construct(MaintenanceMode $resource)
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::guard('web')->user();
        $carbonFactory = UserCarbonFactory::forUser($user);

        return [
            'active' => $this->isActive(),
            'upcoming' => $this->isUpcoming(),
            'from' => $carbonFactory->make($this->from)?->isoFormat('LLL'),
            'to' => $carbonFactory->make($this->to)?->isoFormat('LLL'),
            'message' => $this->display_text,
        ];
    }
}
