<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $aysem = \App\Models\Aysem::all()->random();
        $aysemyear = $aysem->year;

        $middlename = $this->faker->lastName;

        return [
            'student_id' => $aysemyear . $this->faker->unique()->randomNumber(5, true),
            'lastname' => $this->faker->lastName,
            'firstname' => $this->faker->firstName,
            'middlename' => $middlename,
            'middleinitial' => $middlename[0],
            'nameextension' => $this->faker->randomElement(['', 'Jr.', 'Sr.', 'II', 'III', 'IV']),
            'plm_email_address' => $this->faker->unique()->safeEmail,
            'birth_date' => $this->faker->date(),
            'birth_place' => $this->faker->city,
            'age' => $this->faker->numberBetween(15, 30),
            'gender' => $this->faker->randomElement(['Female', 'Male']),
            'civil_status' => $this->faker->randomElement(['Single', 'Married']),
            'mobile_num' => $this->faker->phoneNumber,
            'email_add' => $this->faker->unique()->safeEmail,
            'religion' => $this->faker->randomElement(['Roman Catholic', 'Iglesia ni Cristo', 'Born Again', 'Muslim', 'Protestant']),
            'height' => $this->faker->numberBetween(140, 200),
            'weight' => $this->faker->numberBetween(40, 100),
            'complexion' => $this->faker->randomElement(['Fair', 'Brown', 'Morena', 'Dark']),
            'blood_type' => $this->faker->randomElement(['A', 'B', 'AB', 'O']),
            'telephone_num' => $this->faker->phoneNumber,
            'dominant_hand' => $this->faker->randomElement(['Right', 'Left']),
            'medical_history' => $this->faker->sentence,
            'annual_income' => $this->faker->randomNumber(5, true),
            'q1_answer' => $this->faker->sentence,
            'q2_answer' => $this->faker->sentence,
            'q2a_answer' => $this->faker->sentence,
            'q2b_answer' => $this->faker->sentence,
            'q3_answer' => $this->faker->sentence,
        ];
    }
}
