<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Grade;
use App\Models\TaClass;
use App\Models\Course;

class Grades extends Component
{
    public $grades;
    public $classes;
    public $courses;
    public $tableBody = '';
    public $tableBodyId = '';
    public $totalUnits42 = 0;
    public $totalGrades42 = 0;
    public $countGrades42 = 0;
    public $totalUnits41 = 0;
    public $totalGrades41 = 0;
    public $countGrades41 = 0;
    public $totalUnits32 = 0;
    public $totalGrades32 = 0;
    public $countGrades32 = 0;
    public $totalUnits31 = 0;
    public $totalGrades31 = 0;
    public $countGrades31 = 0;
    public $totalUnits22 = 0;
    public $totalGrades22 = 0;
    public $countGrades22 = 0;
    public $totalUnits21 = 0;
    public $totalGrades21 = 0;
    public $countGrades21 = 0;
    public $totalUnits11 = 0;
    public $totalGrades11 = 0;
    public $countGrades11 = 0;
    public $totalUnits12 = 0;
    public $totalGrades12 = 0;
    public $countGrades12 = 0;
    public $studentId;

    public function mount($studentId)
    {
        $this->studentId = $studentId;
        $this->grades =  Grade::where('student_id', $this->studentId)->get();
        $this->updateAllValues();
    }

    public function render()
    {
        $grades =  Grade::where('student_id', $this->studentId)->get();
        $classes =  TaClass::all();
        $courses =  Course::all();

        return view('livewire.grades', [
            'grades' => $grades,
            'classes' => $classes,
            'courses' => $courses,
        ]);
    }

    private function updateAllValues()
    {
        $this->updateValues(2, 2, '22');
        $this->updateValues(2, 1, '21');
        $this->updateValues(1, 1, '11');
        $this->updateValues(1, 2, '12');

        $this->updateValues(3, 1, '31');
        $this->updateValues(3, 2, '32');
        $this->updateValues(4, 1, '41');
        $this->updateValues(4, 2, '42');
    }

    private function updateValues($year_lvl, $sem, $suffix)
    {
        $totalUnitsVar = 'totalUnits' . $suffix;
        $totalGradesVar = 'totalGrades' . $suffix;
        $countGradesVar = 'countGrades' . $suffix;
    
        $units = $this->grades->where('year_lvl', $year_lvl)
            ->where('sem', $sem)
            ->sum(function ($grade) {
                return $grade->class->course->units;
            });
    
        $sumGrades = $this->grades->where('year_lvl', $year_lvl)
            ->where('sem', $sem)
            ->sum('grades');
    
        $countGrades = $this->grades->where('year_lvl', $year_lvl)
            ->where('sem', $sem)
            ->count();
        
        $this->$totalUnitsVar = $units;
        $this->$countGradesVar = $countGrades;
        $this->$totalGradesVar = $countGrades > 0 ? number_format($sumGrades / $countGrades, 2) : 0;
    }
    
}
