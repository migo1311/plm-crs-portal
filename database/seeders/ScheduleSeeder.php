<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Classes;
use App\Models\ClassSchedule;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $classes = Classes::all();

        foreach ($classes as $class) {
            ClassSchedule::factory()->forClass($class->id)->create();
        }
    }
}
