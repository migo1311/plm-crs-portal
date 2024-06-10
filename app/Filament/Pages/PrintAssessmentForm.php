<?php

namespace App\Filament\Pages;

use App\Models\Aysem;
use App\Models\Student;
use App\Models\Assessment;
use App\Models\Classes;
use Filament\Pages\Page;
use Filament\Forms\Components;
use Filament\Forms\Form;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;

class PrintAssessmentForm extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-plus';
    protected static string $view = 'filament.pages.print-assessment-form';
    protected static ?string $navigationGroup = 'Student Affairs';

    public $studentId;
    public $aysem;
    public $showDetails = false;
    public $assessment;
    public $selectedStudent;
    public $SelectedStudentId = false;
    
    public $data;
    public function mount()
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
    // Fetch student options with Student ID and Last Name as the label
    $students = Student::all();
    $studentOptions = [];
    foreach ($students as $student) {
        $studentOptions[$student->student_no] = $student->student_no . ' (' . $student->last_name . ', ' . $student->first_name .')';
    }

        return $form
            ->columns(2)
            ->schema([
                        Components\Select::make('student_no')
                            ->label('Student ID and Name') // Change the label to indicate both Student ID and Last Name
                            ->placeholder('Select Student') // Change the placeholder accordingly
                            ->options($studentOptions) // Use fetched student options
                            ->required()
                            ->reactive()
                            ->searchable(),
                        Components\Select::make('aysem_id')
                            ->label('Ay-Sem')
                            ->placeholder('Ay-Sem')
                            ->options(Aysem::all()->pluck('id', 'id')->toArray())
                            ->required(),
                    ])->statePath('data');
    }
    
    
    public function submitReport()
    {
        $this->showDetails = true;

        // Load the assessment data based on studentId and aysem
        $this->assessment = Assessment::where('student_no', $this->studentId)
            ->where('aysem_id', $this->aysem)
            ->first();

        // Set flag to true to show the table
        $this->SelectedStudentId = true;
        $this->selectedStudent = Student::find($this->data['student_no']);

    }

    public function resetForm()
    {
        // Reset form data
        $this->form->fill([]);

        // Reset other data properties
        $this->data = [];
        $this->SelectedStudentId = false;
        $this->showDetails = false;
        $this->selectedStudent = null;
    }
}


