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
        $aysemyear = $aysem->academic_year;

        $middlename = $this->faker->lastName;

        $city = \App\Models\City::all()->random();
        $citizenship = \App\Models\Citizenship::all()->random();

        return [
            'student_no' => $aysemyear . $this->faker->unique()->randomNumber(5, true),
            'last_name' => $this->faker->lastName,
            'first_name' => $this->faker->firstName,
            'middle_name' => $middlename,
            'maiden_name' => null,
            'suffix' => null,
            'birthdate' => $this->faker->date(),
            'birthplace_city_id' => $city->id,
            'city_id' => $city->id,
            'permanent_address' => $this->faker->sentence,
            'pedigree' => null,
            'religion' => $this->faker->randomElement(['Roman Catholic', 'Protestant', 'Muslim', 'Iglesia ni Cristo']),
            'biological_sex_id' => \App\Models\BiologicalSex::all()->random()->id,
            'civil_status_id' => \App\Models\CivilStatus::all()->random()->id,
            'citizenship_id' => $citizenship->id,
            'personal_email' => $this->faker->unique()->safeEmail,
            'mobile_no' => $this->faker->randomNumber(5, true) . $this->faker->randomNumber(6, true),
            'telephone_no' => null,
            'photo_link' => null,
            // Academic info
            'entry_date' => now(),
            'aysem_id' => $aysem->id,
            'plm_email' => $this->faker->unique()->safeEmail,
            'paying' => false,
            'password' => null,
            'graduation_date' => null,
            // Medical info
            'height' => $this->faker->numberBetween(140, 200),
            'weight' => $this->faker->numberBetween(40, 100),
            'complexion' => $this->faker->randomElement(['Fair', 'Brown', 'Morena', 'Dark']),
            'blood_type' => $this->faker->randomElement(['A', 'B', 'AB', 'O']),
            'dominant_hand' => $this->faker->randomElement(['Right', 'Left']),
            'medical_history' => $this->faker->sentence,
            // Education
            'lrn' => null,
            'school_name' => null,
            'school_address' => null,
            'school_type' => null,
            'strand' => null,
            'year_entered' => null,
            'year_graduated' => null,
            'honors_awards' => null,
            'general_average' => null,
            'remarks' => null,
            'org_name' => null,
            'org_position' => null,
            'previous_tertiary' => null,
            'previous_sem' => null,
            // Family info
            'father_last_name' => null,
            'father_first_name' => null,
            'father_middle_name' => null,
            'father_address' => null,
            'father_contact_no' => null,
            'father_office_employer' => null,
            'father_office_address' => null,
            'father_office_num' => null,
            'mother_last_name' => null,
            'mother_first_name' => null,
            'mother_middle_name' => null,
            'mother_address' => null,
            'mother_contact_no' => null,
            'mother_office_employer' => null,
            'mother_office_address' => null,
            'mother_office_num' => null,
            'guardian_last_name' => null,
            'guardian_first_name' => null,
            'guardian_middle_name' => null,
            'guardian_address' => null,
            'guardian_contact_no' => null,
            'guardian_office_employer' => null,
            'guardian_office_address' => null,
            'guardian_office_num' => null,
            'annual_family_income' => $this->faker->randomNumber(5, true),
        ];
    }
}
