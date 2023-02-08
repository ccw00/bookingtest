<?php

namespace App\Http\Resources;

use App\Models\Booking;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    public function toArray($request)
    {
        /** @var Booking $resource */
        $resource = $this->resource;

        return [
            'room_id' => $resource->room_id,
            'starts_at' => $resource->starts_at,
            'ends_at' => $resource->ends_at,
        ];
    }
}
