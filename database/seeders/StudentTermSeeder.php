<?php

namespace Database\Seeders;

use App\Models\StudentTerm;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentTermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StudentTerm::factory()
            ->count(10)
            ->create();
    }
}
