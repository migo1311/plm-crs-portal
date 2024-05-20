<?php

namespace App\Filament\Pages;

use App\Models\Student;
use App\Models\Aysem;
use Filament\Pages\Page;
use Filament\Forms\Components;
use Filament\Forms\Form;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Schema;

class StudentInformation extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.student-information';
    protected static ?string $navigationGroup = 'Utilities';

    public ?array $data = [];
    public array $selectedFields = [];
    public array $studentsData = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    protected function getFormSchema(): array
    {
        return [
            Components\Select::make('aysem_id')
                ->label('Ay-Sem')
                ->placeholder('Ay-Sem')
                ->options(Aysem::all()->pluck('aysem_id', 'aysem_id')->toArray())
                ->required(),
            Components\Section::make('Fields to be Included')
                ->schema([
                    Components\Select::make('field_selection')
                        ->label('Field Selection')
                        ->multiple()
                        ->options([
                            'lastname' => 'Last Name',
                            'firstname' => 'First Name',
                            'middlename' => 'Middle Name',
                            'middleinitial' => 'Middle Initial',
                            'nameextension' => 'Name Extension',
                            'yearlevel' => 'Year Level',
                            'plm_email_address' => 'PLM Email Address',
                            'email_add' => 'Email Address',
                            'birth_date' => 'Birthdate',
                            'birth_place' => 'Birthplace',
                            'age' => 'Age',
                            'gender' => 'Gender',
                            'civil_status' => 'Civil Status',
                            'mobile_num' => 'Mobile Number',
                            'religion' => 'Religion',
                            'height' => 'Height',
                            'complexion' => 'Complexion',
                        ])
                        ->required(),
                ]),
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema($this->getFormSchema())
            ->statePath('data');
    }

    public function printReport()
    {
        $this->validate();

        $this->data = $this->form->getState();
        $this->selectedFields = $this->data['field_selection'];
        $aysemId = $this->data['aysem_id'];

        // Validate that the selected fields exist in the Student table
        $validFields = array_filter($this->selectedFields, function ($field) {
            return Schema::hasColumn('students', $field);
        });

        if (count($validFields) !== count($this->selectedFields)) {
            Notification::make()
                ->title('Some selected fields are not valid.')
                ->danger()
                ->send();
            return;
        }

        // Fetch students' data based on valid selected fields and Ay-Sem
        $this->studentsData = Student::where('aysem_id', $aysemId)
            ->limit(20) // Limiting to 20 records for initial display
            ->get()
            ->toArray();

        Notification::make()
            ->title('Data updated successfully!')
            ->success()
            ->send();
    }
}


