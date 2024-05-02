<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AcademicYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AcademicYear::create([
            'academic_year_code' => '2021-2022',
            'date_start' => '2021-09-06',
            'date_end' => '2022-06-30',
        ]);

        AcademicYear::create([
            'academic_year_code' => '2022-2023',
            'date_start' => '2022-09-06',
            'date_end' => '2023-06-30',
        ]);

        AcademicYear::create([
            'academic_year_code' => '2023-2024',
            'date_start' => '2023-09-06',
            'date_end' => '2024-06-30',
        ]);
    }
}
