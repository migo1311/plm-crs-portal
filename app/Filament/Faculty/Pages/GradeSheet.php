<?php

namespace App\Filament\Faculty\Pages;

use App\Models\Aysem;
use App\Models\TaClass;
use App\Models\ClassStudent;
use App\Models\Grade; // Add Grade model
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Form;
use Filament\Forms\Components;
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
    public array $grades = [];

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
                    ->options(Aysem::all()->pluck('aysem_id', 'aysem_id')->toArray())
                    ->required()
                    ->searchable(),
            ])
            ->statePath('data');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(TaClass::query()->where('aysem_id', '=', $this->data['aysem_id'] ?? 0))
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
                    ->action(function (TaClass $record) 
                    {
                        dd($record);
                    })
                    ->icon('heroicon-o-printer')
                    ->color(Color::Amber),
                Action::make('Download')
                    ->action(function (TaClass $record) 
                    {
                        dd($record);
                    })
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color(Color::Amber),
                Action::make('Input Grades')
                    ->action(function (TaClass $record) 
                    {
                        $this->selectedClassId = $record->id;
                        $this->showTable = false;
                        $this->showStudentGradesTable = true;
                        $this->grades = $this->loadGrades();
                    })
                    ->button()
                    ->label('Input Grades')
                    ->color(Color::Blue),
            ]);
    }

    protected function loadGrades()
    {
        $grades = [];
        $classStudents = ClassStudent::where('class_id', $this->selectedClassId)->with('student')->get();

        foreach ($classStudents as $classStudent) {
            $grade = Grade::where('class_student_id', $classStudent->id)->first();
            $grades[$classStudent->id] = $grade ? $grade->grade : null;
        }

        return $grades;
    }


    protected function getStudentGradeSchema(): array
    {
        $schema = [];

        foreach ($this->grades as $classStudentId => $grade) {
            $classStudent = ClassStudent::with('student')->find($classStudentId);
            $student = $classStudent->student;

            $schema[$classStudentId] = (object) [
                'student_number' => $student->student_id,
                'student_name' => $student->lastname,
                'grade' => $grade,
                'grade_input' => Components\TextInput::make("grades.$classStudentId")
                                    ->default($grade)
                                    ->required()
            ];
        }

        return $schema;
    }

    public function submit(): void
    {
        $this->showTable = true;
        $this->showStudentGradesTable = false;
    }

    public function saveGrades(): void
    {
        foreach ($this->grades as $classStudentId => $grade) {
            $classStudent = ClassStudent::find($classStudentId);
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
}
