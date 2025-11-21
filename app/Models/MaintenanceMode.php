<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceMode extends Model
{
    protected $fillable = [
        'enabled',
        'display_text',
        'from',
        'to',
    ];

    protected $casts = [
        'enabled' => 'boolean',
        'from' => 'datetime',
        'to' => 'datetime',
    ];

    public static function current(): ?self
    {
        return static::first();
    }

    public function isActive(): bool
    {
        if ($this->enabled) {
            return true;
        }

        if (! empty($this->from) && ! empty($this->to)) {
            return now()->between($this->from, $this->to);
        }

        return false;
    }

    public function isUpcoming(): bool
    {
        return ! empty($this->from) && now()->lt($this->from);
    }
}
