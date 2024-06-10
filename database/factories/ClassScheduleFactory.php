<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ClassScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $mode = \App\Models\ClassMode::all()->random();
        $room = \App\Models\Room::all()->random();
        $day = \App\Models\Days::all()->random();
        $startTime = $this->faker->time();
        $endTime = $this->faker->time();
        $start = date("g:i A", strtotime($startTime));
        $end = date("g:i A", strtotime($endTime));

        $letter = $day->day_code;

        return [
            'class_id' => \App\Models\Classes::factory(), // Default factory class_id
            'day_id' => $day->id,
            'start_time' => $startTime,
            'end_time'=> $endTime,
            'class_mode_id' => $mode->id,
            'room_id' => $room->id,
            'schedule_name' => $letter . ' ' . $start . ' - ' . $end . ' ' . $mode->mode_code . ' ' . $room->room_name,
        ];
    }

    /**
     * Indicate that the class schedule is for a specific class.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function forClass($classId)
    {
        return $this->state(function (array $attributes) use ($classId) {
            return [
                'class_id' => $classId,
            ];
        });
    }
}
