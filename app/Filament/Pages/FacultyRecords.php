<?php

namespace App\Filament\Pages;

use App\Models\InstructorProfile;
use App\Models\TaClass;
use Filament\Forms\Components;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables; // Add this line

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
                            ->required(),
                        Components\Select::make('gender')
                            ->options([
                                'male' => 'Male',
                                'female' => 'Female',
                                'other' => 'Other',
                            ])
                            ->required(),
                        Components\Select::make('civil_status')
                            ->required(),
                        Components\Select::make('citizenship')
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
                        Components\Grid::make(2) // Define a 2-column grid
                            ->schema([
                                Components\TextInput::make('tin_number')
                                    ->required()
                                    ->columnSpan(1), // Span 1 out of 2 columns
                
                                Components\TextInput::make('gsis_number')
                                    ->required()
                                    ->columnSpan(1), // Span 1 out of 2 columns
                            ]),
                        Components\TextInput::make('instructor_code')
                            ->required()
                            ->columnSpanFull()
                    ]),
                Components\Section::make('Current Address')
                    ->schema([
                        Components\Select::make('street_address')
                            ->required(),
                        Components\Grid::make(2) // Define a 2-column grid
                            ->schema([
                                Components\TextInput::make('zip_code')
                                    ->required()
                                    ->columnSpan(1), // Span 1 out of 2 columns
                
                                Components\TextInput::make('phone_number')
                                    ->required()
                                    ->columnSpan(1), // Span 1 out of 2 columns
                            ]),
                        Components\TextInput::make('province_city')
                            ->required()
                            ->columnSpanFull(),
                    ])
            ])
            ->statePath('data');
    }
}
