<?php

namespace App\Filament\Pages;

use App\Models\Student;
use App\Models\Aysem;
use App\Models\TaClass;
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
                    ->options(Aysem::all()->pluck('aysem_id', 'aysem_id')->toArray())
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
            ]);
    }

    public function table(Table $table): Table
    {
        // Ensure that selectedFields is populated
        $this->selectedFields = is_array($this->selectedFields) ? $this->selectedFields : [];

        // Define columns array
        $columns = [];

        // Add static columns based on selected fields
        $staticColumns = [
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
        ];

        foreach ($staticColumns as $field => $label) {
            if (in_array($field, $this->selectedFields)) {
                $columns[] = TextColumn::make('student.' . $field)
                    ->label($label);
            }
        }

        return $table
            ->query(TaClass::query())
            ->columns($columns);
    }

    public function printReport()
    {
        $this->selectedFields = $this->getOldFormState('data.field_selection') ?? [];
        $this->showTable = true;
    }
}
