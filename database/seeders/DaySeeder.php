<?php

namespace Database\Seeders;

use App\Models\Days;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Days::insert([
            ['day' => 'Monday', 'day_code' => 'M'],
            ['day' => 'Tuesday', 'day_code' => 'T'],
            ['day' => 'Wednesday', 'day_code' => 'W'],
            ['day' => 'Thursday', 'day_code' => 'Th'],
            ['day' => 'Friday', 'day_code' => 'F'],
            ['day' => 'Saturday', 'day_code' => 'S'],
            ['day' => 'Sunday', 'day_code' => 'Su'],
        ]);
    }
}
