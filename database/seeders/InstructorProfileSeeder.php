<?php

namespace Database\Seeders;

use App\Models\InstructorProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstructorProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InstructorProfile::factory()->count(5)->create();
    }
}
