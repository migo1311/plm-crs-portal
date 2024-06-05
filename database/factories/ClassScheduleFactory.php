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
        $classes = \App\Models\Classes::all()->random();
        
        $mode = \App\Models\ClassMode::all()->random();
        $room = \App\Models\Room::all()->random();
        $day = \App\Models\Days::all()->random();
        $startTime = $this->faker->time();
        $endTime = $this->faker->time();
        $start = date("g:i A", strtotime($startTime));
        $end = date("g:i A", strtotime($endTime));

        $letter = $day->day_code;

        return [
            'class_id' => $classes->id,
            'day_id' => $day,
            'start_time' => $startTime,
            'end_time'=> $endTime,
            'class_mode_id' => $mode->id,
            'room_id' => $room->room_id,
            'schedule_name' => $letter . ' ' . $start . ' - ' . $end . ' ' . $mode->mode_code . ' ' . $room->room_name,
        ];
    }
}
