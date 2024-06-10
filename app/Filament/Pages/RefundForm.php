<?php

namespace App\Filament\Pages;

use App\Models\Aysem;
use App\Models\Student;
use App\Models\Assessment;
use Filament\Pages\Page;
use Filament\Forms\Components;
use Filament\Forms\Form;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Table;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;

class RefundForm extends Page implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-wallet';
    protected static string $view = 'filament.pages.refund-form';
    protected static ?string $navigationGroup = 'Student Affairs';

    public ?array $data = [];
    public $showTable = false;
    public $selectedStudent = null;
    public $student_no;
    public $studentId;
    public $SelectedStudentId = false;
    public $aysem_id;

    public function mount()
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        $students = Student::all();
        $studentOptions = [];
        foreach ($students as $student) {
            $studentOptions[$student->student_no] = $student->student_no . ' (' . $student->last_name . ')';
        }

        return $form
            ->columns(2)
            ->schema([
                Components\Select::make('student_no')
                    ->label('Student ID and Name')
                    ->placeholder('Select Student')
                    ->options($studentOptions)
                    ->required()
                    ->reactive()
                    ->searchable(),
                Components\Select::make('aysem_id')
                    ->label('Ay-Sem')
                    ->placeholder('Ay-Sem')
                    ->options(Aysem::all()->pluck('id', 'id')->toArray())
                    ->required(),
            ])->statePath('data');
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(Assessment::query())
            ->columns([
                TextColumn::make('assessment_amount')
                    ->label('Assess Amount')
                    ->formatStateUsing(function ($state, $record) {
                        return $state . '-' . $record->section;
                    }),
                TextColumn::make('amount_paid')
                    ->label('Amount Paid'),
                TextColumn::make('balance')
                    ->label('Balance'),
                TextColumn::make('subsidy')
                    ->label('Subsidy'),
                TextColumn::make('tuition_fee')
                    ->label('Tuition Fee'),
                TextColumn::make('miscellaneous_fee')
                    ->label('Miscellaneous Fee'),
                TextColumn::make('laboratory_fee')
                    ->label('Laboratory Fee'),
                TextColumn::make('other_fee')
                    ->label('Other Fee'),
                TextColumn::make('units')
                    ->label('Units'),
            ]);
    }

    public function submitForm()
    {
        $this->selectedStudent = Student::where('student_no', $this->data['student_no'])->first();

        if ($this->selectedStudent) {
            $hasAssessment = Assessment::where('student_no', $this->data['student_no'])
                ->where('aysem_id', $this->data['aysem_id'])
                ->exists();

            $this->showTable = $hasAssessment;
            $this->SelectedStudentId = true;
        } else {
            $this->showTable = false;
            $this->SelectedStudentId = false;
        }
    }
}
