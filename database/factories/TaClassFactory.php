<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TaClass>
 */
class TaClassFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\TaClass::class;
    
    public function definition(): array
    {
        $course = \App\Models\Course::all()->random();
        $instructor = \App\Models\InstructorProfile::all()->random();
        $aysem = \App\Models\Aysem::all()->random();
        $language = $this->faker->randomElement(['English', 'Filipino']);

        return [
            'course_id' => $course->course_id,
            'section' => $this->faker->numberBetween(1, 5),
            'students_qty' => null, // Initially null
            'credited_units' => $course->units,
            'actual_units' => $this->faker->numberBetween(1, 10),
            'slots' => $this->faker->numberBetween(1, 50),
            'instructor_id' => $instructor->instructor_id,
            'aysem_id' => $aysem->aysem_id,
            'nstp_activity' => null, // Initially null
            'parent_class_code' => null, // Initially null
            'link_type' => null, // Initially null
            'instruction_language' => $language,
            'minimum_year_level' => $this->faker->numberBetween(1, 7),
            'teams_assigned_link' => $this->faker->url,
            'effectivity_dateSL' => $this->faker->date,
        ];
    }
}
