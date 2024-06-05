<?php

namespace Database\Seeders;

use App\Models\BiologicalSex;
use App\Models\City;
use App\Models\CivilStatus;
use App\Models\RegistrationStatus;
use App\Models\Remark;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {   
        // huwag muna si academic year
        // $this->call([AcademicYearSeeder::class]);
        // $this->call([UserSeeder::class]);
        // $this->call([BiologicalSexSeeder::class]);
        // $this->call([CitySeeder::class]);
        // $this->call([CivilStatusSeeder::class]);
        // $this->call([CitizenshipSeeder::class]);
        // $this->call([FeeStatusSeeder::class]);
        // $this->call([RegistrationStatusSeeder::class]);
        // $this->call([DaySeeder::class]);
        // $this->call([AysemSeeder::class]);
        // $this->call([CollegeSeeder::class]);
        // $this->call([ProgramSeeder::class]);
        // $this->call([ClassModeSeeder::class]);
        // $this->call([BuildingSeeder::class]);
        // $this->call([RoomSeeder::class]);
        // $this->call([CourseSeeder::class]);
        // $this->call([BlockSeeder::class]);
        // $this->call([StudentSeeder::class]);
        // $this->call([InstructorSeeder::class]);
        // $this->call([DesignationSeeder::class]);
        // $this->call([ClassSeeder::class]);
        $this->call([ClassStudentSeeder::class]);
        // $this->call([ScheduleSeeder::class]);
        // $this->call([StudentTermSeeder::class]);
    }
}
