<?php

namespace App\Filament\Pages;

use App\Models\Student;
use App\Models\Aysem;
use Filament\Pages\Page;
use Filament\Forms\Components;
use Filament\Forms\Form;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Table;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;

class StudentInformation extends Page implements HasForms, HasTable
{
    use InteractsWithForms, InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.student-information';

    protected static ?string $navigationGroup = 'Utilities';

    public $showTable = false;
    public $selectedFields = [];

    public function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Components\Select::make('aysem_id')
                    ->label('Ay-Sem')
                    ->placeholder('Ay-Sem')
                    ->options(Aysem::all()->pluck('aysem_id')->toArray())
                    ->required(),
                Components\Section::make('Fields to be Included')
                    ->schema([
                        Components\Select::make('field_selection')
                            ->label('Field Selection')
                            ->multiple()
                            ->options([
                                'plm_email_address' => 'PLM Email Address',
                                'email_address' => 'Email Address',
                                'birthdate' => 'Birthdate',
                                'birthplace' => 'Birthplace',
                                'age' => 'Age',
                                'gender' => 'Gender',
                                'civil_status' => 'Civil Status',
                                'mobile_number' => 'Mobile Number',
                                'religion' => 'Religion',
                                'height' => 'Height',
                                'complexion' => 'Complexion',
                            ])
                            ->required(),
                    ]),
            ])
            ->statePath('data');
    }

    public function table(Table $table): Table
    {
        // Get the selected fields
        $selectedFields = $this->selectedFields;

        // Define columns array
        $columns = [];

        // Add selected fields as columns
        foreach ($selectedFields as $field) {
            // Use TextColumn::make to define a column for each selected field
            $columns[] = TextColumn::make($field)->label(ucwords(str_replace('_', ' ', $field)));
        }

        // Set the query for the table
        $table->query(Student::query());

        // Set the columns for the table
        $table->columns($columns);

        return $table;
    }

    public function printReport()
    {
    $this->selectedFields = $this->getOldFormState('data.field_selection');

    $this->showTable = true;
    }
}
