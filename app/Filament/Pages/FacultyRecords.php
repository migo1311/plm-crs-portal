<?php

namespace App\Filament\Pages;

use App\Models\BiologicalSex;
use App\Models\Citizenship;
use App\Models\City;
use App\Models\CivilStatus;
use App\Models\Instructor;
use Filament\Forms\Components;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;

class FacultyRecords extends Page implements HasForms
{
    use InteractsWithForms;
    protected static ?string $navigationIcon = 'heroicon-o-folder';
    protected static string $view = 'filament.pages.faculty-records';
    protected static ?string $navigationGroup = 'Utilities';

    public ?array $data = [];
    public Instructor $instructorProfile;

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->columns(4)
            ->model(Instructor::class)
            ->schema([
                Components\Section::make('Personal Details')
                    ->schema([
                        Components\Select::make('instructor_id')
                            ->label('Employee Number')
                            ->options(Instructor::all()->pluck('id', 'id')->toArray())
                            ->searchable()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(fn ($state) => $this->loadInstructorData($state)),
                        Components\TextInput::make('last_name')->label('Last Name')->required(),
                        Components\TextInput::make('first_name')->label('First Name')->required(),
                        Components\TextInput::make('middle_name')->label('Middle Name'),
                        Components\TextInput::make('maiden_name')->label('Maiden Name')->columnSpan(2),
                        Components\DatePicker::make('birth_date')->required(),
                        Components\Select::make('pedigree')
                            ->options(['Jr.' => 'Jr.', 'N/A' => 'N/A', 'I' => 'I', 'II' => 'II', 'III'])->required(),
                        Components\Select::make('biological_sex')->options(BiologicalSex::all()->pluck('sex', 'sex')->toArray())->searchable()->required(),
                        Components\Select::make('civil_status')->options(CivilStatus::all()->pluck('civil_status', 'civil_status')->toArray())->searchable()->required(),
                        Components\Select::make('citizenship')->options(Citizenship::all()->pluck('citizenship', 'citizenship')->toArray())->searchable()->required(),
                        Components\TextInput::make('mobile_phone')->required()->columnSpan(2),
                        Components\TextInput::make('email_address')->required()->columnSpan(2)
                    ]),
                Components\Section::make('Employment Details')
                    ->schema([
                        Components\Grid::make(2)
                            ->schema([
                                Components\TextInput::make('tin_number')->required()->columnSpan(1),
                                Components\TextInput::make('gsis_number')->required()->columnSpan(1),
                            ]),
                        Components\Select::make('instructor_code')->options(Instructor::all()->pluck('instructor_code', 'instructor_code')->toArray())->searchable()->required()->columnSpanFull()
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
                                Components\TextInput::make('zip_code')->required()->columnSpan(1),
                                Components\TextInput::make('phone_number')->required()->columnSpan(1),
                            ]),
                        Components\Select::make('city_id')
                            ->options(City::all()->pluck('city_name', 'id'))
                            ->columnSpanFull(),
                    ])
            ])
            ->statePath('data');
    }

    public function loadInstructorData($instructorId)
    {
        $instructor = Instructor::find($instructorId);
        if ($instructor) {
            $formState = $instructor->toArray();
            $formState['instructor_id'] = $instructorId;  // Ensure instructor_id is included
            $this->form->fill($formState);
        }
    }

    public function create()
    {
        $formData = $this->form->getState();
        $this->validate();

        $instructorProfile = Instructor::find($formData['instructor_id']);

        if ($instructorProfile) {
            $instructorProfile->update($formData);

            Notification::make()
                ->title('Data updated successfully!')
                ->success()
                ->send();
        } else {
            Notification::make()
                ->title('Instructor not found!')
                ->danger()
                ->send();
        }
    }

    public function resetForm()
    {
        $this->form->fill([]);
    }

}
