<?php

namespace Database\Seeders;

use App\Models\College;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CollegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        College::insert([
            [
                'college_code' => 'COE',
                'college_name' => 'College of Engineering'
            ],
            [
                'college_code' => 'CISTM',
                'college_name' => 'College of Information System and Technology Management'
            ],
            [
                'college_code' => 'CE',
                'college_name' => 'College of Education'
            ],
            [
                'college_code' => 'CAUP',
                'college_name' => 'College of Architecture and Urban Planning'
            ],
            [
                'college_code' => 'CHASS',
                'college_name' => 'College of Humanities, Arts and Social Sciences'
            ],
            [
                'college_code' => 'GSL',
                'college_name' => 'Graduate School of Law'
            ],
            [
                'college_code' => 'CL',
                'college_name' => 'College of Law'
            ],
            [
                'college_code' => 'CM',
                'college_name' => 'College of Medicine'
            ],
            [
                'college_code' => 'CN',
                'college_name' => 'College of Nursing'
            ],
            [
                'college_code' => 'CPT',
                'college_name' => 'College of Physical Therapy'
            ],
            [
                'college_code' => 'CS',
                'college_name' => 'College of Science'
            ],
            [
                'college_code' => 'PLM BS',
                'college_name' => 'PLM Business School'
            ],
            [
                'college_code' => 'SG',
                'college_name' => 'School of Government'
            ],
            [
                'college_code' => 'SPH',
                'college_name' => 'School of Public Health'
            ]
        ]);
    }
}
