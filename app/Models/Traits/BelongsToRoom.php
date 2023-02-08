<?php

namespace App\Models\Traits;

use App\Models\Room;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToRoom
{
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function getRoom(): ?Room
    {
        return $this->room()->first();
    }
}
