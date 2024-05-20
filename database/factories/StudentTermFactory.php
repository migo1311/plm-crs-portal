<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentTerm>
 */
class StudentTermFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $aysem = \App\Models\Aysem::all()->random();
        $aysemid = $aysem->aysem_id;

        do {
            $student = \App\Models\Student::all()->random()->student_id;
            $exists = \App\Models\StudentTerm::query()
                ->where('student_id', $student)
                ->where('aysem_id', $aysemid)->value('student_term_id');
        } while ($exists);

        return [
            'student_id' => $student,
            'college_id' => \App\Models\College::all()->random()->college_id,
            'program_id' => $this->faker->randomElement([2, 3, 4]),
            'academic_year' => $aysem->academicYear->academic_year_code,
            'semester' => $aysem->semester_code,
            'aysem_id' => $aysemid,
            'block_id' => \App\Models\Block::all()->random()->block_id,
            'year_level' => $this->faker->numberBetween(1, 5),
            'registration_status' => $this->faker->randomElement(['Regular', 'Irregular']),
            'student_type' => $this->faker->randomElement(['New', 'Old', 'Transferee', 'Shifter']),
            'graduating' => $this->faker->randomElement(['Yes', 'No']),
            'enrolled' => 1,
        ];
    }
}
