<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InstructorProfile>
 */
class InstructorProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\InstructorProfile::class;
    
    public function definition(): array
    {
        $aysem = \App\Models\Aysem::all()->random();
        $aysemyear = $aysem->year;
        $firstname = $this->faker->firstName;
        $lastname = $this->faker->lastName;
        $middlename = $this->faker->lastName;
        // $name = explode(' ', $firstname);
        // $result = $name[0][0]. $name[1][0]
        $instructorcode = Str::upper($firstname[0]) . Str::upper($lastname) . $this->faker->unique()->randomNumber(2, true);
        $facultyname = Str::upper($lastname) . ', ' . Str::upper($firstname) . ' ' . Str::upper($middlename[0]) . '. (' . $instructorcode . ')';

        return [
            'instructor_id' => $aysemyear . $this->faker->unique(true)->randomNumber(6, true),
            'last_name' => $lastname,
            'first_name' => $firstname,
            'middle_name' => $middlename,
            'pedigree' => $this->faker->randomElement(['', 'Dr.', 'Engr.', 'Atty.']),
            'birth_place' => $this->faker->city,
            'birth_date' => $this->faker->date(),
            'gender' => $this->faker->randomElement(['Female', 'Male']),
            'civil_status' => $this->faker->randomElement(['Single', 'Married']),
            'citizenship' => $this->faker->randomElement(['Filipino', 'American', 'Chinese', 'Japanese']),
            'mobile_phone' => $this->faker->phoneNumber,
            'email_address' => $this->faker->unique()->safeEmail,
            'tin_number' => $this->faker->unique()->randomNumber(9, true),
            'gsis_number' => $this->faker->unique()->randomNumber(9, true),
            'instructor_code' => $instructorcode,
            'street_address' => $this->faker->streetAddress,
            'province_city' => $this->faker->city,
            'zip_code' => $this->faker->randomNumber(4, true),
            'phone_number' => $this->faker->phoneNumber,
            'faculty_name' => $facultyname,
            'college_id' => \App\Models\College::query()->where('college_code', '=', 'CISTM')->value('college_id'),
        ];
    }
}
