<?php

namespace Database\Factories;

use App\Models\StudyPlanValidations;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudyPlanValidations>
 */
class StudyPlanValidationsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = StudyPlanValidations::class;

    public function definition()
    {
      $student = Student::inRandomOrder()->first(); // Fetch a random student record
      $firstName = $this->faker->firstName;
      $lastName = $this->faker->lastName;
      $middleInitial = strtoupper(substr($this->faker->firstName, 0, 1)) . '.';
      return [
        'student_id' => $student->student_id, // Use the ID from the fetched student
        'year_level' => $this->faker->numberBetween(1, 4),
        'date_of_request' => $this->faker->date,
        'status' => $this->faker->randomElement(['Pending', 'Approved', 'Revise',]),
        
      ];
    }
}
