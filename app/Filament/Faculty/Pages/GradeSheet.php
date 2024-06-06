<?php

namespace App\Filament\Faculty\Pages;

use App\Models\Aysem;
use App\Models\Classes;
use App\Models\ClassStudent;
use App\Models\Grade; // Add Grade model
use App\Models\Student;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Form;
use Filament\Forms\Components;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Pages\Page;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Support\Colors\Color;

class GradeSheet extends Page implements HasForms, HasTable
{
    use InteractsWithForms, InteractsWithTable;
    
    protected static ?string $navigationIcon = 'heroicon-o-document-check';
    protected static string $view = 'filament.faculty.pages.grade-sheet';
    protected static ?int $navigationSort = 3;

    public ?array $data = [];
    public $showTable = false;
    public $showStudentGradesTable = false;
    public $selectedClassId;
    public ?array $classGrades = [];
    public array $grades = [], $students = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Components\Select::make('aysem_id')
                    ->label('Ay-Sem')
                    ->placeholder('Ay-Sem')
                    ->options(Aysem::all()->pluck('id', 'id')->toArray())
                    ->required()
                    ->searchable(),
            ])
            ->statePath('data');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Classes::query()->where('aysem_id', '=', $this->data['aysem_id'] ?? 0))
            ->columns([
                TextColumn::make('course.subject_code')
                    ->label('Class')
                    ->sortable(),
                TextColumn::make('section')
                    ->label('Section')
                    ->sortable(),
                TextColumn::make('course.subject_title')
                    ->label('Subject Title')
                    ->wrap(),
                TextColumn::make('classSchedules.schedule_name')
                    ->label('Schedule')
                    ->wrap(),
                TextColumn::make('instructor.instructor_code')
                    ->label('Instructor')
            ])
            ->actions([
                Action::make('Print')
                    ->action(function (Classes $record) 
                    {
                        dd($record);
                    })
                    ->icon('heroicon-o-printer')
                    ->color(Color::Amber),
                Action::make('Download')
                    ->action(function (Classes $record) 
                    {
                        dd($record);
                    })
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color(Color::Amber),
                Action::make('Input Grades')
                    ->action(function (Classes $record) 
                    {
                        $attributes = $record->getAttributes();
                        $this->selectedClassId = $attributes['id']; // Check if the selected class is correct
                        $this->showTable = false;
                        $this->showStudentGradesTable = true;
                        $this->students = $this->loadStudents();
                    })
                    ->button()
                    ->label('Input Grades')
                    ->color(Color::Blue),
            ]);
    }

    protected function loadStudents()
    {
        $students = [];
        $classStudents = Classes::whereHas('student', function($query)  {
            $query->where('class_id', $this->selectedClassId);
        })->with('student')->get();
        
        foreach ($classStudents as $classStudent) {
            $student = $classStudent->getAttributes();
            // $grade = Grade::query()->where('class_student_id', $student['class_student_id'])->first();
            $students[] = $student;
            // $grades[$classStudent->id] = $grade ? $grade->grade : null;
        }

        return $students;
    }

    public function studentGradesForm(Form $form): Form
    {
        return $form
            ->model(Grade::class)
            ->schema([
                Textarea::make('students.firstname')
                    ->formatStateUsing(function ($state, $record) {
                        return $state . ' ' . $record->middleinitial . ' ' . $record->lastname;
                    })
                    ->readOnly(),
            ])
            ->statePath('classGrades');
    }

    protected function getStudentGradeSchema(): array
    {
        $schema = [];

        foreach ($this->students as $classStudentIdx => $value) { // as index => array value
            
            // $classStudent = Classes::all()->find($classStudentIdx['class_id']);
            $studentId = $value['id'];
            $student = Student::query()->where('student_no', $studentId)->first()->getAttributes();
            $name = $student['firstname'] . ' ' . $student['middleinitial'] . '. ' . $student['lastname'];

            $schema[$classStudentIdx] = (object) [
                'student_number' => $studentId,
                'student_name' => $name,
                'grade_input' => Components\Select::make("grades")
                                    ->options([
                                        '1.0' => '1.0',
                                        '1.25' => '1.25',
                                        '1.5' => '1.5',
                                        '1.75' => '1.75',
                                        '2.0' => '2.0',
                                        '2.25' => '2.25',
                                        '2.5' => '2.5',
                                        '2.75' => '2.75',
                                        '3.0' => '3.0',
                                        '4.0' => '4.0',
                                        '5.0' => '5.0',
                                    ])
                                    ->required()
            ];
        }

        return $schema;
    }

    public function submit(): void
    {
        $this->validateOnly($this->data['aysem_id']);
        $this->showTable = true;
        $this->showStudentGradesTable = false;

    }

    public function saveGrades(): void
    {
        foreach ($this->grades as $classStudentId => $grade) {
            $classStudent = Classes::whereHas('student', function($query)  {
                $query->where('class_id', $this->selectedClassId);
            })->with('student')->find($classStudentId);
            $gradeModel = Grade::where('class_student_id', $classStudentId)->first();
            if ($gradeModel) {
                $gradeModel->update(['grade' => $grade]);
            } else {
                Grade::create(['class_student_id' => $classStudentId, 'grade' => $grade]);
            }
        }

        session()->flash('message', 'Grades saved successfully!');
        $this->showTable = true;
        $this->showStudentGradesTable = false;
    }

    protected function getForms(): array
    {
        return [
            'form' => $this->form($this->makeForm()),
            'studentGradesForm' => $this->studentGradesForm($this->makeForm())
        ];
    }

}
