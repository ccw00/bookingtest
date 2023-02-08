<?php

namespace Database\Seeders;

use App\Models\Block;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Booking::factory(15)->create();
        Block::factory(15)->create();

        $rooms = Room::factory(15)->create();

        /** @var Room $room */
        foreach ($rooms as $room) {
            if ($room->capacity > 2) {
                Booking::factory()
                    ->forRoom($room)
                    ->create();
                Block::factory()
                    ->forRoom($room)
                    ->create();
            }
        }
    }
}
