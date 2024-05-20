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
use Filament\Forms\Components\Radio;

class StudentRecords extends Page implements HasForms
{
    use InteractsWithForms;
    protected static ?string $navigationIcon = 'heroicon-o-identification';

    protected static string $view = 'filament.pages.student-records';

    protected static ?string $navigationGroup = 'Utilities';

    public ?array $data = [];
    public Student $student;

    
    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->columns(4)
            ->model(StudentGrades::class)
            ->schema([
                Components\Section::make('First Step')
                    ->columns(2)
                    ->schema([
                        Components\Select::make('student_id')
                            ->label('Student Number')
                            ->options(Student::all()->pluck('student_id', 'student_id')->toArray())
                            ->searchable()
                            ->required(),
                        Components\Select::make('aysem_id')
                            ->label('Ay-Sem')
                            ->placeholder('Ay-Sem')
                            ->options(Aysem::all()->pluck('aysem_id', 'aysem_id')->toArray())
                            ->required()
                            ->searchable(), 
                    ]),
                Components\Section::make('Personal Details')
                    ->schema([
                        Components\Select::make('student_id')
                            ->label('Student Number')
                            ->options(Student::all()->pluck('student_id', 'student_id')->toArray())
                            ->searchable()
                            ->required(),
                        Components\TextInput::make('last_name')
                            ->label('Last Name')
                            ->required(),
                        Components\TextInput::make('first_name')
                            ->label('First Name')
                            ->required(),
                        Components\TextInput::make('middle_name')
                            ->label('Middle Name'),
                        Components\TextInput::make('maiden_name')
                            ->label('Maiden Name'),
                        Components\TextInput::make('name_extension')
                            ->label('Name Extension'),
                        Components\TextInput::make('birth_place')
                            ->label('Birth Place (Province-City)')
                            ->required(),
                        Components\DatePicker::make('birth_date')
                            ->required(),
                        Components\Select::make('gender')
                            ->options([
                                'male' => 'Male',
                                'female' => 'Female',
                                'other' => 'Other',
                            ])
                            ->required(),
                        Components\Select::make('civil_status')
                            ->options([
                                'single' => 'Single',
                                'married' => 'Married',
                                'divorced' => 'Divorced',
                                'widowed' => 'Widowed',
                            ])
                            ->required(),
                        Components\TextInput::make('mobile_num')
                            ->required(),
                        Components\TextInput::make('email_add')
                            ->required()
                            ->columnSpan(2)
                    ]),
                Components\Section::make('Student Terms')
                    ->columns(4)
                    ->schema([
                        Components\TextInput::make('aysem_id')
                            ->required()
                            ->columnSpan(2)
                            ->required(),
                        Components\TextInput::make('program_id')
                            ->label('Program')
                            ->required(),
                        Components\Select::make('block_id')
                            ->label('Block')
                            ->options([
                                '1' => '1',
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                            ])
                            ->required(),
                        Components\TextInput::make('college_id')
                            ->label('College')
                            ->required(),
                        Components\Select::make('registration_status')
                            ->options([
                                'regular' => 'Regular',
                                'irregular' => 'Irregular',
                            ])
                            ->required(),
                        Components\Select::make('student_type')
                            ->options([
                                'old' => 'Old',
                                'new' => 'New',
                                'transferee' => 'Transferee',
                                'shifter' => 'Shifter',
                            ])
                            ->required()
                            ->columnSpan(2),
                        Components\Select::make('graduating')
                            ->options([
                                'yes' => 'Yes',
                                'No' => 'No',
                            ])
                            ->required(),
                        Components\Select::make('yearlevel')
                            ->options([
                                '1' => '1',
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                                '5' => '5',
                            ])
                            ->required(),
                        Radio::make('enrolled')
                            ->options([
                                'yes' => 'Yes',
                                'no' => 'No',
                            ])
                            ->inline(false)
                            ->default('') // optional: set a default value
                            ->rules('required'), // optional: enforce a rule
                    ])
            ])
            ->statePath('data');
    }

    public function create()
    {
        $this->validate();

        $this->data = $this->form->getState();

        Notification::make()
            ->title('Data updated successfully!')
            ->success()
            ->send();
    }
}
