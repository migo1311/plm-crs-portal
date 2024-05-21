<?php

namespace App\Filament\Pages;

use App\Models\Student;
use App\Models\Aysem;
use App\Models\StudentFamily;
use App\Models\TaClass;
use App\Models\Block;
use App\Models\College;
use Filament\Pages\Page;
use Filament\Forms\Components;
use Filament\Forms\Form;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Table;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Livewire\Component;

class StudentInformationReport extends Page implements HasForms, HasTable
{
    use InteractsWithForms, InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.student-information-report';
    protected static ?string $navigationGroup = 'Print Forms';

    public $showTable = false;

    public $selectedStudent, $studentFamily, $blockStats, $college;
    public $studentId;
    public $SelectedStudentId = false; // New property to hold the selected student's data

    public function mount()
    {
        // Set the initial value of $studentId if not already set
        if (!$this->studentId) {
            $this->studentId = Student::first()->student_id;
        }
    }

    public function form(Form $form): Form
    {
    // Fetch student options with Student ID and Last Name as the label
    $students = Student::all();
    $studentOptions = [];
    foreach ($students as $student) {
        $studentOptions[$student->student_id] = $student->student_id . ' (' . $student->lastname . ', ' . $student->firstname .')';
    }

    return $form
        ->columns(2)
        ->schema([
            Components\Select::make('student_id')
                ->label('Student ID and Name') // Change the label to indicate both Student ID and Last Name
                ->placeholder('Select Student') // Change the placeholder accordingly
                ->options($studentOptions) // Use fetched student options
                ->required()
                ->reactive()
                ->afterStateUpdated(fn ($state) => $this->updateSelectedStudent($state['student_id'])),
            Components\Select::make('aysem_id')
                ->label('Ay-Sem')
                ->placeholder('Ay-Sem')
                ->options(Aysem::all()->pluck('aysem_id', 'aysem_id')->toArray())
                ->required(),
        ]);
    }

    public function updateSelectedStudent($studentId)
    {
        $this->studentId = $studentId;
        $this->selectedStudent = Student::find($studentId);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(TaClass::query()) // Ensure it fetches the correct data
            ->columns([
                TextColumn::make('course.subject_code')
                    ->label('Subject Code')
                    ->formatStateUsing(function ($state, $record) {
                        return $state . '-' . $record->section;
                    })
                    ->sortable(),
                TextColumn::make('section')
                    ->label('Section')
                    ->sortable(),
                TextColumn::make('course.subject_title')
                    ->label('Subject Title'),
                TextColumn::make('course.units')
                    ->label('Units'),
                TextColumn::make('classSchedules.schedule_name')
                    ->label('Schedule'),
                TextColumn::make('instructor.faculty_name')
                    ->label('Faculty')
            ]);
    }

    public function printReport()
    {
        // Set flag to true to show the table
        $this->showTable = true;
        $this->SelectedStudentId = true;
        $this->selectedStudent = Student::find($this->studentId);
        $this->blockStats = Block::where('block_id', $this->selectedStudent->block_id)->first();
        $this->college = College::where('college_id', $this->selectedStudent->college_id)->first();
        $this->studentFamily = StudentFamily::where('student_family_id', $this->selectedStudent->student_family_id)->first();
    }
}
