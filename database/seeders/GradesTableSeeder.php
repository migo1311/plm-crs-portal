<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\TaClass;
use App\Models\Grade;

class GradesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Specify the student ID
        $specificStudentId = 202225744; // Replace with your specific student_id

        // Ensure the student exists
        $student = Student::firstOrCreate([
            'student_id' => $specificStudentId,
        ], [

        ]);

        // Create grades for the specific student for class_id 1 to 50
        for ($classId = 1; $classId <= 50; $classId++) {
            // Ensure the class exists
            $class = TaClass::firstOrCreate([
                'class_id' => $classId,
            ], [
                // Add other necessary fields here if needed
                'name' => "Class $classId",
                // Add other fields
            ]);

            // Create grades for the specific student and class
            Grade::factory()->create([
                'student_id' => $specificStudentId,
                'class_id' => $classId,
            ]);
        }
    }
}