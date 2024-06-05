<?php

namespace App\Filament\Pages;

use App\Models\Student;
use App\Models\StudyPlanValidations;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use App\Models\User;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\EditAction as ActionsEditAction;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Filament\Tables\Columns\CheckboxColumn;
use App\Models\InstructorProfile;
use App\Models\TaClass;
use Filament\Forms\Components;
use Filament\Forms\Concerns\InteractsWithForms;

class StudyPlanValidation extends Page implements HasForms, HasTable
{
    use Forms\Concerns\InteractsWithForms;
    use Tables\Concerns\InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.study-plan-validation';
    protected static ?string $navigationGroup = 'Transactions';

    public $students;
    public $student_id, $lastname, $year_level, $status, $date_of_request, $study_plan;
    public $student_edit_id, $student_delete_id;
    public $view_student_id, $view_lastname, $view_student_year_level, $view_status;
    public $bulk_student_status, $lastPage;
    public $year;
    public $bulkEditStudentIds = [];
    public $selectedStudents = [];
    public $selectAll = false;
    public $perPage = 10;
    public $currentPage = 1;
    public $numStudents;
    public $totalStudents;
    public $courses;
    public $validations;
    public $activeButton = '';
    public $hasStudyPlan = false;
    public $hasChecklist = false;
    public $selectedStudentId;
    public $sortColumn = 'lastname'; // Default sorting column
    public $sortDirection = 'asc'; // Default sorting direction

    public function mount()
    {
        $this->students = Student::all(); // Assuming Student is your model
        $this->getPaginatedStudents();
        $this->calculateTotalStudents();
    }

    public function calculateTotalStudents()
    {
        $this->totalStudents = StudyPlanValidations::count();
    }

    public function sortStudents($column)
    {
        if ($this->sortColumn === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
    
        $this->sortColumn = $column;
        $this->getPaginatedStudents();
    }
    
    public function getPaginatedStudents()
    {
        $total = StudyPlanValidations::count();
        $this->lastPage = ceil($total / $this->perPage);
        $this->currentPage = min(max(1, $this->currentPage), $this->lastPage);
        $offset = ($this->currentPage - 1) * $this->perPage;
    
        $orderByDirection = $this->sortDirection === 'desc' ? 'DESC' : 'ASC';
    
        if ($this->sortColumn === 'year_level') {
            $this->students = $this->getPaginatedStudentsByYear($orderByDirection, $offset);
        } else {
            $this->students = $this->getPaginatedStudentsByName($orderByDirection, $offset);
        }
    }

    public function nextPage($pageName = 'page')
    {
        $this->currentPage++;
        $this->getPaginatedStudents();
    }
    
    public function previousPage($pageName = 'page')
    {
        $this->currentPage--;
        $this->getPaginatedStudents();
    }
        
    public function getPaginatedStudentsByName($orderByDirection, $offset)
    {
        return StudyPlanValidations::join('students', "study_plan_validations.student_id", "=", "students.student_id")
            ->orderBy('lastname', $orderByDirection)
            ->skip($offset)
            ->take($this->perPage)
            ->get();
    }

    public function getPaginatedStudentsByYear($orderByDirection, $offset)
    {
        return StudyPlanValidations::orderBy('year_level', $orderByDirection)
            ->skip($offset)
            ->take($this->perPage)
            ->get();
    }

    public function toggleStudentSelection($studentId)
    {
        if (in_array($studentId, $this->selectedStudents)) {
            $this->selectedStudents = array_diff($this->selectedStudents, [$studentId]);
        } else {
            $this->selectedStudents[] = $studentId;
        }
    }

    public function selectStudentsForBatchUpdate()
    {
        if (count($this->selectedStudents) < 1) {
            session()->flash('error', 'Please select at least more than one student for batch update.');
            return;
        }
    
        if (count($this->selectedStudents) === 1) {
            session()->flash('error', 'Please select more than one student for batch update.');
            return;
        }
    
        $this->bulkEditStudentIds = $this->selectedStudents;
        $this->dispatch('open-bulk-edit-modal');
    }
    
    public function applyBatchUpdate()
    {
        $this->validate([
            'bulk_student_status' => 'required|string|in:Pending,Approved,Revise,Unhandled',
        ], [
            'bulk_student_status.required' => 'Status input is required.',
        ]);
    
        if (count($this->bulkEditStudentIds) < 1) {
            session()->flash('error', 'Please select at least more than one student for batch update.');
            return;
        }
    
        foreach ($this->bulkEditStudentIds as $studentId) {
            $student = StudyPlanValidations::findOrFail($studentId);
            $student->update(['status' => $this->bulk_student_status]);
        }
    
        session()->flash('message', 'Batch update applied successfully.');
    
        $this->bulk_student_status = '';
        $this->bulkEditStudentIds = [];
    
        $this->dispatch('close-modal');
    }
    
    public function closeBatchUpdateModal()
    {
        $this->selectedStudents = [];
        $this->dispatch('close-modal');
    }

    public function updated($field)
    {
        $this->validateOnly($field, $this->rules);
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

    public function cancel()
    {
        $this->student_delete_id = '';
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

    public function changeColor($button)
    {
        $this->activeButton = $button;
    }

    public function form(Form $form): Form
    {
        return $form
            ->columns(2)
            ->model(StudyPlanValidations::class)
            ->schema([
               Components\Section::make('Personal Details')
                    ->schema([
                        Components\Select::make('student_id')
                            ->label('Student ID')
                            ->options(StudyPlanValidations::all()->pluck('student_id', 'student_id')->toArray())
                            ->searchable()
                            ->required(),
                    ]),

            ])
            ->statePath('data');
    }


    public function table(Table $table): Table
    {
        return $table
            ->query(function () {
                return StudyPlanValidations::query();
            })
            ->columns([
                CheckboxColumn::make(' '),
                TextColumn::make('student_id')->label('Student ID')->sortable()->searchable(),
                TextColumn::make('student.lastname')->label('Student Name')->sortable()->searchable(),
                TextColumn::make('year_level')->label('Year Level')->sortable(),
                TextColumn::make('date_of_request')->label('Date Request')->sortable(),
                TextColumn::make('status')->label('Status')->sortable(),
            ])
            ->filters([])
            ->actions([
                Action::make('View Student')
                    ->registerModalActions([
                        Action::make('report')
                            ->requiresConfirmation()
                            ->action(fn (Post $record) => $record->report()),
                        Action::make('edit')
                            ->registerModalActions([
                                Action::make('View Student')
                                    ->action(fn (Post $record) => $this->editStudents($record->student_id)),
                            ]),
                    ]),
            ]);
    }
}