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
            $student = \App\Models\Student::all()->random()->student_no;
            $exists = \App\Models\StudentTerm::query()
                ->where('student_no', $student)
                ->where('aysem_id', $aysemid)->value('id');
        } while ($exists);

        return [
            'student_no' => $student,
            'aysem_id' => $aysemid,
            'program_id' => \App\Models\Program::all()->random()->id,
            'block_id' => \App\Models\Block::all()->random()->id,
            'registration_status_id' => \App\Models\RegistrationStatus::all()->random()->id,
            'student_type' => $this->faker->randomElement(['New', 'Old', 'Transferee', 'Shifter']),
            'graduating' => false,
            'enrolled' => true,
            'year_level' => $this->faker->numberBetween(1, 5),
        ];
    }
}
