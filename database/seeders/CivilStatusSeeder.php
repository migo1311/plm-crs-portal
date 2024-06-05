<?php

namespace Database\Seeders;

use App\Models\CivilStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CivilStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CivilStatus::insert([
            ['civil_status' => 'Single'],
            ['civil_status' => 'Married'],
            ['civil_status' => 'Widowed'],
            ['civil_status' => 'Separated'],
            ['civil_status' => 'Divorced'],
        ]);
    }
}
