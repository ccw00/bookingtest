<?php

namespace Database\Factories;

use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlockFactory extends Factory
{
    public function definition()
    {
        $randomStartDays = rand(1, 5);

        return [
            'room_id' => Room::query()->create(
                [
                    'capacity' => rand(2, 6),
                ]
            ),
            'starts_at' => Carbon::now()->addDays($randomStartDays),
            'ends_at' => Carbon::now()->addDays($randomStartDays + rand(2, 7)),
        ];
    }

    public function withStartsAt(Carbon $startDate): BlockFactory
    {
        return $this->state(function (array $attributes) use ($startDate) {
            return [
                'starts_at' => $startDate,
            ];
        });
    }

    public function withEndsAt(Carbon $endDate): BlockFactory
    {
        return $this->state(function (array $attributes) use ($endDate) {
            return [
                'ends_at' => $endDate,
            ];
        });
    }

    public function forRoom(Room $room): BlockFactory
    {
        return $this->state(function (array $attributes) use ($room) {
            return [
                'room_id' => $room->id,
            ];
        });
    }
}
