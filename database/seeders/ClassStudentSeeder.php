<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\TaClass;
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
        $classes = TaClass::all();
        $students = Student::all();

        foreach ($students as $student) {
            $classIds = $classes->random(rand(1, 3))->pluck('class_id');
            $student->classes()->attach($classIds);

            foreach ($classIds as $classId) {
                $class = TaClass::find($classId);
                if ($class) {
                    $class->updateStudentsQuantity();
                }
            }
        }
        
    }
}
