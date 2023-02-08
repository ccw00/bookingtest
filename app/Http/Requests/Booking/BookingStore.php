<?php

namespace App\Http\Requests\Booking;

use App\Http\Requests\BaseRequest;
use App\Models\Room;
use App\Rules\RoomRules\RoomHasEmptyCapacity;

class BookingStore extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'room_id' => [
                'required',
                'integer',
                'exists:' . Room::class . ',id',
                new RoomHasEmptyCapacity(),
            ],
            'starts_at' => [
                'required',
                'date',
                'after:today',
                'before:ends_at',
            ],
            'ends_at' => [
                'required',
                'date',
                'after:starts_at',
            ],
        ];
    }
}
