<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TaClass>
 */
class ClassesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\Classes::class;
    
    public function definition(): array
    {
        $course = \App\Models\Course::all()->random();
        $aysem = \App\Models\Aysem::all()->random();
        $language = $this->faker->randomElement(['English', 'Filipino']);

        return [
            'course_id' => $course->id,
            'block_id' => \App\Models\Block::all()->random()->id,
            'students_qty' => null, // Initially null
            'credited_units' => $course->units,
            'actual_units' => $this->faker->numberBetween(1, 5),
            'slots' => $this->faker->numberBetween(1, 50),
            'aysem_id' => $aysem->id,
            'nstp_activity' => null, // Initially null
            'parent_class_code' => null, // Initially null
            'link_type' => null, // Initially null
            'instruction_language' => $language,
            'minimum_year_level' => null,
            'teams_assigned_link' => $this->faker->url,
            'effectivity_dateSL' => $this->faker->date,
        ];
    }
}
