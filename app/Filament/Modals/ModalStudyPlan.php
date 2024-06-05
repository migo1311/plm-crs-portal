<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ShiftingRequest;
use App\Models\Course;
use App\Models\Validation;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Livewire;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;


class ModalStudyPlan extends Page implements HasTable
{
    public $allowedCourseCodes = [];
    public $courses;
    public $tableBody = '';
    public $tableBodyId = '';
    public $totalUnits32 = 0;
    public $totalUnits42 = 0;
    public $totalUnits72 = 0;
    public $totalUnits62 = 0;
    public $totalUnits22 = 0;
    public $units;
    public $studentName;
    public $yearlvl;
    public $student_id;
    public $studyPlanCodes;
    public $studentId;
    public $yearLevel;
    public $status;
    public $lastname, $year_level, $date_of_request, $study_plan;
    public $view_student_id, $view_lastname, $view_student_year_level, $view_status;
    public $sortColumn = 'lastname';
    public $hasYear2;

    public function getPaginatedStudentsByName($orderByDirection, $offset)
    {
        return StudyPlanValidations::join('students', "study_plan_validations.student_id", "=", "students.student_id")
            ->orderBy('lastname', $orderByDirection)
            ->skip($offset)
            ->take($this->perPage)
            ->get();
    }

    public function editStudents($id)
    {
        $student = StudyPlanValidations::where('student_id', $id)->first();

        $this->student_edit_id = $student->student_id;
        $this->student_id = $student->student_id;
        $this->lastname = $student->lastname;
        $this->year_level = $student->year_level;
        $this->status = $student->status;
        $this->date_of_request = $student->date_of_request;
        $this->study_plan = $student->study_plan;
        
        $this->selectedStudentId = $student->student_id;

        $this->dispatch('show-edit-student-modal');
    }

    public function editStudentData()
    {
        $this->validate([
            'student_id' => 'required|unique:students,student_id,'.$this->student_edit_id,
            'lastname' => 'required',
            'year_level'=> 'required|integer',
            'status' => 'required|string|in:Pending,Approved,Revise,Unhandled',
            'date_of_request' => 'required|date',
            'study_plan' => 'required|string',
        ]);

        $student = StudyPlanValidations::findOrFail($this->student_edit_id);
        $student->update([
            'student_id' => $this->student_id,
            'lastname' => $this->lastname,
            'year_level' => $this->year_level,
            'status' => $this->status,
            'date_of_request' => $this->date_of_request,
            'study_plan' => $this->study_plan,
        ]);

        session()->flash('message', 'Student has been updated successfully');
        $this->dispatch('close-modal');
    }

    public function viewStudentDetails($id)
    {
        $student = StudyPlanValidations::findOrFail($id);

        $this->view_student_id = $student->student_id;
        $this->view_lastname = $student->lastname;
        $this->view_student_year_level = $student->year_level;
        $this->view_status = $student->status;
        $this->date_of_request = $student->date_of_request;
        $this->dispatch('show-view-student-modal');
    }   

    public function closeViewStudentModal()
    {
        $this->view_student_id = '';
        $this->view_lastname = '';
        $this->view_student_year_level = '';
        $this->view_status = '';
        $this->date_of_request = '';
        $this->dispatch('close-view-student-modal');
    }




    protected $listeners = ['studentSelected' => 'updateStudentId']; 

    public function mount($studentId)
    {

        $this->student_id = $studentId; // Assigning the value passed from Livewire component invocation to $this->student_id
        $this->loadStudentData();

        $this->courses = Course::all();
        $this->tableBodyId = '';
        $this->updateTotalUnits32();
        $this->updateTotalUnits42();
        $this->updateTotalUnits72();
        $this->updateTotalUnits62();
        $this->updateTotalUnits22();

        $displayedCourseCodes = $this->getDisplayedCourseCodes();

        $hasYear2 = false;
        $hasYear3 = false;
        $hasYear4 = false;

        $totalUnits32 = 0;
        $totalUnits42 = 0;
        $totalUnits72 = 0;
        $totalUnits62 = 0;
        $totalUnits22 = 0;

        foreach ($students as $student) {
            if ($student->student_id === $this->student_id) {
                if ($student->year_level === 2 && !$hasYear2) {
                    $hasYear2 = true;
                    $hasYear3 = true;
                    $hasYear4 = true;
                } elseif ($student->year_level === 3 && !$hasYear3) {
                    $hasYear3 = true;
                    $hasYear4 = true;
                } elseif ($student->year_level === 4 && !$hasYear4) {
                    $hasYear4 = true;
                }
            }
        }

        $this->hasYear2 = $hasYear2;
        $this->hasYear3 = $hasYear3;
        $this->hasYear4 = $hasYear4;

        $this->totalUnits32 = $totalUnits32;
        $this->totalUnits42 = $totalUnits42;
        $this->totalUnits72 = $totalUnits72;
        $this->totalUnits62 = $totalUnits62;

        $this->displayedCourseCodes = $displayedCourseCodes;
    }

    public function updateStudentId($studentId)
    {
        $this->studentId = $studentId;
        $this->loadStudentData();
    }

    public function updateTotalUnits($tableBodyId, $unitChange)
    {
        $totalUnitsKey = str_replace('tableBody', 'totalUnits', $tableBodyId);
        if (property_exists($this, $totalUnitsKey)) {
            $this->$totalUnitsKey += $unitChange;
        }
    }

    public function getDisplayedCourseCodes()
    {
        $courseCodes = $this->courses->filter(function ($course) {
            return in_array($course->course_code, $this->allowedCourseCodes);
        })->pluck('course_code');

        return $courseCodes;
    }

    public function pushReject(){
        // Get the validation record for the current student
        $shift_request = ShiftingRequest::where('student_id', $this->student_id)->first();
    
        if ($shift_request) {
            $shift_request->status = 'Revise';
            $shift_request->save();
        }

    }

    public function render()
    {
        $student = Student::find($this->student_id);

        // Check if the student is found
        if ($student) {
            // If found, retrieve the necessary student information
            $this->lastname = $student->lastname;
            $this->yearLevel = $student->year_level;
            // Fetch other necessary data and assign them to their respective variables
        }
        return view('filament.modals.modal-studyplan', [
            'validations' => Validation::all(),
            'courses' => Validation::all(),
            'hasYear2' => $this->hasYear2,
            'hasYear3' => $this->hasYear3,
            'hasYear4' => $this->hasYear4,
            'totalUnits32' => $this->totalUnits32,
            'totalUnits42' => $this->totalUnits42,
            'totalUnits72' => $this->totalUnits72,
            'totalUnits62' => $this->totalUnits62,
            'displayedCourseCodes' => $this->displayedCourseCodes,
            'studentName' => $this->studentName,
            'yearLevel' => $this->yearLevel,
            'studyPlanCodes' => $this->studyPlanCodes,
            'allowedCourseCodes' => $this->allowedCourseCodes,
            'status' => $this->status,
            'lastname' => $this->lastname,
        ]);
    }

    private function updateTotalUnits32()
    {
        $this->totalUnits32 = $this->courses
            ->whereIn('course_code', $this->allowedCourseCodes)
            ->where('year_lvl', 3)
            ->where('sem', 1)
            ->sum('units');
    }

    private function updateTotalUnits42()
    {
        $this->totalUnits42 = $this->courses
            ->whereIn('course_code', $this->allowedCourseCodes)
            ->where('year_lvl', 3)
            ->where('sem', 2)
            ->sum('units');
    }

    private function updateTotalUnits72()
    {
        $this->totalUnits72 = $this->courses
            ->whereIn('course_code', $this->allowedCourseCodes)
            ->where('year_lvl', 4)
            ->where('sem', 1)
            ->sum('units');
    }

    private function updateTotalUnits62()
    {
        $this->totalUnits62 = $this->courses
            ->whereIn('course_code', $this->allowedCourseCodes)
            ->where('year_lvl', 4)
            ->where('sem', 2)
            ->sum('units');
    }

    private function updateTotalUnits22()
    {
        $this->totalUnits22 = $this->courses
            ->whereIn('course_code', $this->allowedCourseCodes)
            ->where('year_lvl', 2)
            ->where('sem', 2)
            ->sum('units');
    }
}