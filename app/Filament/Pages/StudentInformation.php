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
                ->options(Aysem::all()->pluck('aysem_id', 'aysem_id')->toArray())
                ->required()
                ->searchable(), // Make the Ay-Sem field searchable
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
            ->limit(10)
            ->get()
            ->toArray();

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
