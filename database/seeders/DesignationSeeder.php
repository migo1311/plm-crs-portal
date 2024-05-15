<?php

namespace Database\Seeders;

use App\Models\Designation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Designation::insert([
            [
                'title' => 'Instructor 1',
                'eq_units' => 18,
                'type_load' => 'RL'
            ],
            [
                'title' => 'Instructor 2',
                'eq_units' => 18,
                'type_load' => 'RL'
            ],
            [
                'title' => 'Instructor 3',
                'eq_units' => 18,
                'type_load' => 'RL'
            ],
            [
                'title' => 'Part-time Instructor',
                'eq_units' => 18,
                'type_load' => 'SL'
            ],
            [
                'title' => 'Full-time Instructor',
                'eq_units' => 18,
                'type_load' => 'EL'
            ],
            [
                'title' => 'Associate Professor',
                'eq_units' => 18,
                'type_load' => 'StL'
            ],
            [
                'title' => 'Assistant Professor',
                'eq_units' => 18,
                'type_load' => 'SL'
            ],
            [
                'title' => 'Associate Dean',
                'eq_units' => 18,
                'type_load' => 'AL'
            ],
            [
                'title' => 'Dean',
                'eq_units' => 18,
                'type_load' => 'AL'
            ],
            [
                'title' => 'Department Chair',
                'eq_units' => 18,
                'type_load' => 'AL'
            ],
            [
                'title' => 'Vice President',
                'eq_units' => 18,
                'type_load' => 'AL'
            ],
            [
                'title' => 'President',
                'eq_units' => 18,
                'type_load' => 'AL'
            ]
        ]);


    }
}
