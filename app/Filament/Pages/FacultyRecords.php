<?php

namespace App\Filament\Pages;

use App\Models\InstructorProfile;
use Filament\Forms\Components;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;

class FacultyRecords extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.faculty-records';
    protected static ?string $navigationGroup = 'Utilities';

    public ?array $data = [];
    public InstructorProfile $instructorProfile;

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->columns(4)
            ->model(InstructorProfile::class)
            ->schema([
                Components\Section::make('Personal Details')
                    ->schema([
                        Components\Select::make('instructor_id')
                            ->label('Employee Number')
                            ->options(InstructorProfile::all()->pluck('instructor_id', 'instructor_id')->toArray())
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
                            ->label('Maiden Name')
                            ->columnSpan(2),
                        Components\TextInput::make('birth_place')
                            ->label('Birth Place (Province-City)')
                            ->required()
                            ->columnSpan(2),
                        Components\DatePicker::make('birth_date')
                            ->required(),
                        Components\Select::make('pedigree')
                            ->options([
                                'I' => 'I',
                                'II' => 'II',
                                'III' => 'III',
                                'IV' => 'IV',
                                'V' => 'V',
                            ])
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
                                'widowed' => 'Widowed',
                                'divorced' => 'Divorced',
                                'separated' => 'Separated',
                            ])
                            ->required(),
                        Components\Select::make('citizenship')
                            ->options([
                                'Philippines' => 'Philippines',
                                'United States' => 'United States',
                                'Canada' => 'Canada',
                                'Australia' => 'Australia',
                                'United Kingdom' => 'United Kingdom',
                                'Germany' => 'Germany',
                                'France' => 'France',
                                'Japan' => 'Japan',
                                'China' => 'China',
                                'India' => 'India',
                                'Other' => 'Other',
                            ])
                            ->required(),
                        Components\TextInput::make('mobile_phone')
                            ->required()
                            ->columnSpan(2),
                        Components\TextInput::make('email_address')
                            ->required()
                            ->columnSpan(2)
                    ]),
                Components\Section::make('Employment Details')
                    ->schema([
                        Components\Grid::make(2) 
                            ->schema([
                                Components\TextInput::make('tin_number')
                                    ->required()
                                    ->columnSpan(1), 
                                Components\TextInput::make('gsis_number')
                                    ->required()
                                    ->columnSpan(1),
                            ]),
                        Components\TextInput::make('instructor_code')
                            ->required()
                            ->columnSpanFull()
                    ]),
                Components\Section::make('Current Address')
                    ->schema([
                        Components\Select::make('street_address')
                            ->options([
                                'Escolta Street' => 'Escolta Street',
                                'Ayala Boulevard' => 'Ayala Boulevard',
                                'Taft Avenue' => 'Taft Avenue',
                                'Roxas Boulevard' => 'Roxas Boulevard',
                                'Pedro Gil Street' => 'Pedro Gil Street',
                                'Orosa Street' => 'Orosa Street',
                                'Adriatico Street' => 'Adriatico Street',
                                'Remedios Street' => 'Remedios Street',
                                'P. Burgos Street' => 'P. Burgos Street',
                                'R. Hidalgo Street' => 'R. Hidalgo Street',
                            ])
                            ->required(),
                        Components\Grid::make(2) 
                            ->schema([
                                Components\TextInput::make('zip_code')
                                    ->required()
                                    ->columnSpan(1), 
                                Components\TextInput::make('phone_number')
                                    ->required()
                                    ->columnSpan(1), 
                            ]),
                        Components\TextInput::make('province_city')
                            ->required()
                            ->columnSpanFull(),
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
