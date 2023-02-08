<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    public function definition()
    {
        return [
            'capacity' => fake()->numberBetween(2, 6),
        ];
    }

    public function withCapacity(string $capacity)
    {
        return $this->state(function (array $attributes) use ($capacity) {
            return [
                'capacity' => $capacity,
            ];
        });
    }
}
