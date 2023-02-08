<?php

namespace App\Http\Services;

use Illuminate\Database\Eloquent\Collection;

class OccupancyRateService
{
    public static function compute(Collection $rooms, int $precision = 2): float
    {
        $totalRoomsCapacity = 0;
        $totalBookings = 0;
        $totalBlocks = 0;

        foreach ($rooms as $room) {
            $totalRoomsCapacity += $room->capacity;
            $totalBookings += $room->bookings_count;
            $totalBlocks += $room->not_available_blocks_count;
        }

        return round($totalBookings / ($totalRoomsCapacity - $totalBlocks), $precision);
    }
}
