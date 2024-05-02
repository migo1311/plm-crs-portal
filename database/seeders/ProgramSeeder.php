<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Program::insert([
            [
                'college_id' => 1,
                'program_title' => 'Bachelor of Science in Civil Engineering',
                'program_code' => 'BSCE',
                'major' => 'Civil Engineering',
                'degree' => 'Bachelor of Science',
                'degree_level' => "Bachelor's",
                'num_credits' => 150,
            ],
            [
                'college_id' => 2,
                'program_title' => 'Bachelor of Science in Computer Science',
                'program_code' => 'BSCS',
                'major' => 'Computer Science',
                'degree' => 'Bachelor of Science',
                'degree_level' => "Bachelor's",
                'num_credits' => 150,
            ],
            [
                'college_id' => 2,
                'program_title' => 'Bachelor of Science in Information Technology',
                'program_code' => 'BSIT',
                'major' => 'Information Technology',
                'degree' => 'Bachelor of Science',
                'degree_level' => "Bachelor's",
                'num_credits' => 150,
            ],
            [
                'college_id' => 2,
                'program_title' => 'Master of Science in Information and Communications Technology',
                'program_code' => 'MICT',
                'major' => 'Information and Communications Technology',
                'degree' => 'Master of Science',
                'degree_level' => "Master's",
                'num_credits' => 36,
            ],
            [
                'college_id' => 6,
                'program_title' => 'Master of Laws',
                'program_code' => 'LLM',
                'major' => 'Law',
                'degree' => 'Master of Laws',
                'degree_level' => "Master's",
                'num_credits' => 36,
            ],
            [
                'college_id' => 7,
                'program_title' => 'Juris Doctor',
                'program_code' => 'JD',
                'major' => 'Law',
                'degree' => 'Juris Doctor',
                'degree_level' => "Doctorate",
                'num_credits' => 90,
            ],
            [
                'college_id' => 8,
                'program_title' => 'Doctor of Medicine',
                'program_code' => 'MD',
                'major' => 'Medicine',
                'degree' => 'Doctor of Medicine',
                'degree_level' => "Doctorate",
                'num_credits' => 270,
            ],
        ]);
    }
}
