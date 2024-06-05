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

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static string $view = 'filament.pages.student-information';
    protected static ?string $navigationGroup = 'Utilities';

    public ?array $data = [];
    public array $selectedFields = [];
    public array $studentsData = [];
    public string $search = '';

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
                ->options(Aysem::all()->pluck('id', 'id')->toArray())
                ->required()
                ->searchable(), // Make the Ay-Sem field searchable
            Components\Section::make('Fields to be Included')
                ->schema([
                    Components\Select::make('field_selection')
                        ->label('Field Selection')
                        ->multiple()
                        ->options([
                            'last_name' => 'Last Name',
                            'first_name' => 'First Name',
                            'middle_name' => 'Middle Name',
                            'maiden_name' => 'Maiden Name',
                            'suffix' => 'Suffix',
                            'plm_email' => 'PLM Email Address',
                            'personal_email' => 'Personal Email Address',
                            'birthdate' => 'Birthdate',
                            'permanent_address' => 'Home Address',
                            'mobile_no' => 'Mobile Number',
                            'religion' => 'Religion',
                            'height' => 'Height',
                            'weight' => 'Weight',
                            'complexion' => 'Complexion',
                            'blood_type' => 'Blood Type',
                            'dominant_hand' => 'Dominant Hand',
                            'medical_history' => 'Medical History',
                        ])
                        ->required()
                        ->searchable(), // Make the Field Selection field searchable
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

    // Fetch students' data based on valid selected fields and Ay-Sem, including search functionality
    $query = Student::where('aysem_id', $aysemId);

        if ($this->search) {
            $query->where(function ($q) {
                foreach ($this->selectedFields as $field) {
                    $q->orWhere($field, 'like', '%' . $this->search . '%');
                }
            });
        }

        $this->studentsData = Student::select($validFields)
            ->limit(5)
            ->get()
            ->toArray();

        shuffle($this->studentsData);

    // Display success notification only if there are search results
    if (!empty($this->studentsData)) {
        Notification::make()
            ->title('Data updated successfully!')
            ->success()
            ->send();
    } else {
        Notification::make()
            ->title('No records found!')
            ->info()
            ->send();
        }
    }
}