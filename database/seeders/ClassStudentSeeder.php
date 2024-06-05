<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Classes;
use App\Models\Grade;
use Filament\Forms\Components\Tabs\Tab;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = Classes::all()->random(1);
        $students = Student::all()->random(1);

        foreach ($students as $student) {
            $classIds = $classes->pluck('id');
            $student->classes()->attach($classIds);

            foreach ($classIds as $classId) {
                $class = Classes::find($classId);
                if ($class) {
                    $class->updateStudentsQuantity();
                }

                
            }
        }
        
    }
}
