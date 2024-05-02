<?php

namespace Database\Seeders;

use App\Models\Aysem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AysemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Aysem::create([
            'aysem_id' => 20211,
            'academic_year_id' => 1,
            'year' => 2021,
            'semester_index' => 1,
            'semester_code' => '1st Semester',
            'date_end' => '2022-01-31',
            'date_start' => '2021-09-06',
        ]);

        Aysem::create([
            'aysem_id' => 20212,
            'academic_year_id' => 1,
            'year' => 2021,
            'semester_index' => 2,
            'semester_code' => '2nd Semester',
            'date_end' => '2022-06-30',
            'date_start' => '2022-01-31',
        ]);

        Aysem::create([
            'aysem_id' => 20213,
            'academic_year_id' => 1,
            'year' => 2021,
            'semester_index' => 3,
            'semester_code' => 'Summer',
            'date_end' => '2022-09-01',
            'date_start' => '2022-07-01',
        ]);

        Aysem::create([
            'aysem_id' => 20221,
            'academic_year_id' => 2,
            'year' => 2022,
            'semester_index' => 1,
            'semester_code' => '1st Semester',
            'date_end' => '2023-01-31',
            'date_start' => '2022-09-06',
        ]);

        Aysem::create([
            'aysem_id' => 20222,
            'academic_year_id' => 2,
            'year' => 2022,
            'semester_index' => 2,
            'semester_code' => '2nd Semester',
            'date_end' => '2023-06-30',
            'date_start' => '2023-01-31',
        ]);

        Aysem::create([
            'aysem_id' => 20223,
            'academic_year_id' => 2,
            'year' => 2022,
            'semester_index' => 3,
            'semester_code' => 'Summer',
            'date_end' => '2022-09-01',
            'date_start' => '2022-07-01',
        ]);

        Aysem::create([
            'aysem_id' => 20231,
            'academic_year_id' => 3,
            'year' => 2023,
            'semester_index' => 1,
            'semester_code' => '1st Semester',
            'date_end' => '2024-01-31',
            'date_start' => '2023-09-06',
        ]);

        Aysem::create([
            'aysem_id' => 20232,
            'academic_year_id' => 3,
            'year' => 2023,
            'semester_index' => 2,
            'semester_code' => '2nd Semester',
            'date_end' => '2024-06-30',
            'date_start' => '2024-01-31',
        ]);

        Aysem::create([
            'aysem_id' => 20233,
            'academic_year_id' => 3,
            'year' => 2023,
            'semester_index' => 3,
            'semester_code' => 'Summer',
            'date_end' => '2022-09-01',
            'date_start' => '2022-07-01',
        ]);
        
    }
}
