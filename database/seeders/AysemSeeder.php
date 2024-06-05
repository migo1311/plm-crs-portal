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
            'id' => 20211,
            'academic_year' => 2021,
            //'academic_year_code' => 2021-2022,
            'semester' => 1,
            //'academic_year_sem' => 2021-1,
            'date_end' => '2022-01-31',
            'date_start' => '2021-09-06',
        ]);

        Aysem::create([
            'id' => 20212,
            'academic_year' => 2021,
            //'academic_year_code' => 2021-2022,
            'semester' => 2,
            //'academic_year_sem' => 2021-2,
            'date_end' => '2022-06-30',
            'date_start' => '2022-01-31',
        ]);

        Aysem::create([
            'id' => 20213,
            'academic_year' => 2021,
            //'academic_year_code' => 2021-2022,
            'semester' => 3,
            //'academic_year_sem' => 2021-3,
            'date_end' => '2022-09-01',
            'date_start' => '2022-07-01',
        ]);

        Aysem::create([
            'id' => 20221,
            'academic_year' => 2022,
            //'academic_year_code' => 2022-2023,
            'semester' => 1,
            //'academic_year_sem' => 2022-1,
            'date_end' => '2023-01-31',
            'date_start' => '2022-09-06',
        ]);

        Aysem::create([
            'id' => 20222,
            'academic_year' => 2022,
            //'academic_year_code' => 2022-2023,
            'semester' => 2,
            //'academic_year_sem' => 2022-2,
            'date_end' => '2023-06-30',
            'date_start' => '2023-01-31',
        ]);

        Aysem::create([
            'id' => 20223,
            'academic_year' => 2022,
            //'academic_year_code' => 2022-2023,
            'semester' => 3,
            //'academic_year_sem' => 2022-3,
            'date_end' => '2022-09-01',
            'date_start' => '2022-07-01',
        ]);

        Aysem::create([
            'id' => 20231,
            'academic_year' => 2023,
            //'academic_year_code' => 2023-2024,
            'semester' => 1,
            //'academic_year_sem' => 2023-1,
            'date_end' => '2024-01-31',
            'date_start' => '2023-09-06',
        ]);

        Aysem::create([
            'id' => 20232,
            'academic_year' => 2023,
            //'academic_year_code' => 2023-2024,
            'semester' => 2,
            //'academic_year_sem' => 2023-2,
            'date_end' => '2024-06-30',
            'date_start' => '2024-01-31',
        ]);

        Aysem::create([
            'id' => 20233,
            'academic_year' => 2023,
            ///'academic_year_code' => 2023-2024,
            'semester' => 3,
            //'academic_year_sem' => 2023-3,
            'date_end' => '2022-09-01',
            'date_start' => '2022-07-01',
        ]);
        
    }
}
