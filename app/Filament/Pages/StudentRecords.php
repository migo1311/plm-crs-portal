<?php

namespace App\Filament\Pages;

use App\Models\Student;
use App\Models\Aysem;
use Filament\Forms\Components;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;

class StudentRecords extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-identification';
    protected static string $view = 'filament.pages.student-records';
    protected static ?string $navigationGroup = 'Student Affairs';

    public ?array $data = [];

    public $aysem_id;
    public Student $Student;

    public function mount(): void
    {
        $this->form->fill([]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->model(Student::class)
            ->columns(4)
            ->schema([
                Components\Section::make('Select')
                    ->columns(2)
                    ->schema([
                        Components\Select::make('student_no')
                            ->label('Student Number')
                            ->placeholder('Select Student Number')
                            ->options(Student::all()->pluck('student_no', 'student_no')->toArray())
                            ->searchable()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(fn($state) => $this->loadStudentData($state)),
                        Components\Select::make('aysem_id')
                            ->label('Ay-Sem')
                            ->placeholder('Ay-Sem')
                            ->options(Aysem::all()->pluck('id', 'id')->toArray())
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(fn($state) => $this->updateAysem($state)),
                    ]),
                Components\Section::make('Student Terms')
                    ->columns(4)
                    ->schema([
                        Components\TextInput::make('aysem_id')
                            ->label('Ay-Sem')
                            ->required()
                            ->disabled(true),
                        Components\TextInput::make('studentTerms.program.program_code')
                            ->label('Program')
                            ->required(),
                        Components\Select::make('studentTerms.block_id')
                            ->label('Block')
                            ->options([
                                '1' => '1',
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                            ])
                            ->required(),
                        Components\TextInput::make('studentTerms.college_id')
                            ->label('College')
                            ->required(),
                        Components\TextInput::make('studentTerms.registration_status')
                            ->label('Registration Status')
                            ->disabled(true),
                        Components\Select::make('studentTerms.student_type')
                            ->options([
                                'old' => 'Old',
                                'new' => 'New',
                                'transferee' => 'Transferee',
                                'shifter' => 'Shifter',
                            ])
                            ->required(),
                        Components\TextInput::make('studentTerms.graduating')
                            ->label('Graduating') // Set default value to 'no'
                            ->disabled(true),
                        Components\Select::make('studentTerms.year_level')
                            ->options([
                                '1' => '1',
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                                '5' => '5',
                            ])
                            ->required(),
                    ]),
                Components\Section::make('Personal Details')
                    ->columns(4)
                    ->schema([
                        Components\TextInput::make('student_no')
                            ->label('Student Number')
                            ->placeholder('Select Student Number')
                            ->required()
                            ->disabled(true),
                        Components\TextInput::make('last_name')
                            ->label('Last Name')
                            ->required()
                            ->disabled(true),
                        Components\TextInput::make('first_name')
                            ->label('First Name')
                            ->required()
                            ->disabled(true),
                        Components\TextInput::make('middle_name')
                            ->label('Middle Name')
                            ->disabled(true),
                        Components\TextInput::make('maiden_name')
                            ->label('Maiden Name')
                            ->disabled(true),
                        Components\TextInput::make('name_extension')
                            ->label('Name Extension')
                            ->disabled(true),
                        Components\DatePicker::make('birthdate')
                            ->label('Birth Date')
                            ->required()
                            ->disabled(true),
                        Components\TextInput::make('mobile_no')
                            ->label('Mobile Number'),
                        Components\TextInput::make('personal_email')
                            ->label('Email Address')
                            ->columnSpan(2),
                    ]),
            ])
            ->statePath('data');
    }

    public function loadStudentData($studentId)
    {
        $student = Student::find($studentId);
        if ($student) {
            $formState = $student->toArray();
            $formState['student_no'] = $studentId;
            $this->data['student_no'] = $studentId;
            $this->form->fill($formState);
        }
    }
    
    public function updateAysem($aysemId)
    {
        $this->form->fill(['aysem_id' => $aysemId]);
    }
    public function create()
{
    $formData = $this->form->getState();
    $this->validate(); 


    $student = Student::find($this->data['student_no']);
    if ($student) {
        $student->update($formData);
        Notification::make()
            ->title('Data updated successfully!')
            ->success()
            ->send();
    } else {
        Notification::make()
            ->title('Student not found!')
            ->danger()
            ->send();
    }
}

    /*public function search()
    {
        $this->showForms = true;
    }*/

    public function resetForm()
    {
        $this->form->fill([]);
        $this->data = [];
    }

    public function loadData()
    {
    // Retrieve all student records from the database and convert to array
    $this->data = Student::all()->toArray();
    }
}