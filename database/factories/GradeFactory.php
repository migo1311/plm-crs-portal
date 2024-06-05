<?php

namespace Database\Factories;

use App\Models\Grade;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Grade>
 */
class GradeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Grade::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $possibleValues = [1.0, 2.0, 3.0, 5.0];
        
        return [
            'class_student_id' => null,
            'initial_grade' => $this->faker->randomElement($possibleValues),
            'final_grade' => $this->faker->randomElement($possibleValues),
            'finalization_date' => $this->faker->date(),
            'completion_grade' => $this->faker->randomElement($possibleValues),
            'remark_id' => null,
            'class_id' => \App\Models\TaClass::factory(),
            'student_id' => \App\Models\Student::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
