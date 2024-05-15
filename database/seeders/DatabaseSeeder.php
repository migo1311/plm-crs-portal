<?php

namespace Database\Seeders;

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
        // $this->call([AcademicYearSeeder::class]);
        // $this->call([AysemSeeder::class]);
        // $this->call([CollegeSeeder::class]);
        // $this->call([ProgramSeeder::class]);
        // $this->call([ModeSeeder::class]);
        // $this->call([BuildingSeeder::class]);
        // $this->call([RoomSeeder::class]);
        // $this->call([CourseSeeder::class]);
        // $this->call([RemarkSeeder::class]);
        // $this->call([BlockSeeder::class]);
        // $this->call([StudentSeeder::class]);
        // $this->call([InstructorProfileSeeder::class]);
        // $this->call([DesignationSeeder::class]);
        // $this->call([UserSeeder::class]);
        $this->call([DesignationSeeder::class]);
    }
}
