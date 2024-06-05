<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InstructorProfile>
 */
class InstructorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\Instructor::class;
    
    public function definition(): array
    {
        $aysem = \App\Models\Aysem::all()->random();
        $aysemyear = $aysem->academic_year;
        $firstname = $this->faker->firstName;
        $lastname = $this->faker->lastName;
        $middlename = $this->faker->lastName;
        // $name = explode(' ', $firstname);
        // $result = $name[0][0]. $name[1][0]
        $instructorcode = Str::upper($firstname[0]) . Str::upper($lastname) . $this->faker->unique()->randomNumber(2, true);
        $facultyname = Str::upper($lastname) . ', ' . Str::upper($firstname) . ' ' . Str::upper($middlename[0]) . '. (' . $instructorcode . ')';

        return [
            'id' => $aysemyear . $this->faker->unique(true)->randomNumber(6, true),
            'last_name' => $lastname,
            'first_name' => $firstname,
            'middle_name' => $middlename,
            'maiden_name' => null,
            'instructor_code' => $instructorcode,
            'pedigree' => $this->faker->randomElement(['', 'I', 'II', 'III', 'Jr.', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X']),
            'birth_date' => $this->faker->date(),
            'birthplace_id' => \App\Models\City::all()->random()->id,
            'city_id' => \App\Models\City::all()->random()->id,
            'biological_sex_id' => \App\Models\BiologicalSex::all()->random()->id,
            'civil_status_id' => \App\Models\CivilStatus::all()->random()->id,
            'citizenship_id' => \App\Models\Citizenship::all()->random()->id,
            'college_id' => \App\Models\College::query()->where('college_code', '=', 'CISTM')->value('id'),
            'mobile_phone' => $this->faker->phoneNumber,
            'email_address' => $this->faker->unique()->safeEmail,
            'tin_number' => $this->faker->unique()->randomNumber(9, true),
            'gsis_number' => $this->faker->unique()->randomNumber(9, true),
            'street_address' => $this->faker->streetAddress,
            'zip_code' => $this->faker->randomNumber(4, true),
            'phone_number' => $this->faker->phoneNumber,
            'faculty_name' => $facultyname,
        ];
    }
}
