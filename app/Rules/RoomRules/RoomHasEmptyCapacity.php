<?php

namespace App\Rules\RoomRules;

use App\Models\Room;
use Illuminate\Contracts\Validation\Rule;

class RoomHasEmptyCapacity implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        /** @var Room $room */
        $room = Room::query()->find($value);

        return $room->hasOneEmptyCapacity();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Selected room must have at least one capacity empty.';
    }
}
