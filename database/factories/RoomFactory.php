<?php

namespace Database\Factories;

use App\Models\Building;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Room::class;

    public function definition(): array
    {
        $model = new Building();
        $id = $model->all()->random()->id;
        $name = Building::query()->where('id', '=', $id)->value('building_code');
        $number = $this->faker->randomNumber(3, true);

        return [
            'building_id' => $id,
            'room_number' => $number,
            'room_name' => $name . ' ' . $number, 
        ];
    }
}
