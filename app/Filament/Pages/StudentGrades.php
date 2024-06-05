<?php

namespace App\Filament\Pages;

use App\Models\Aysem;
use App\Models\Classes;
use App\Models\Student;
use Filament\Pages\Page;
use Filament\Forms\Components;
use Filament\Forms\Form;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Table;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;

class StudentGrades extends Page implements HasForms, HasTable
{
    use InteractsWithForms, InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-trophy';
    protected static string $view = 'filament.pages.student-grades';
    protected static ?string $navigationGroup = 'Print Forms';
    public ?array $data = [];
    public $showTable = false;
    public $selectedStudentName = '';

    public function form(Form $form): Form
    {
        // Fetch student options with Student ID and Last Name as the label
        $students = Student::all();
        $studentOptions = [];
        foreach ($students as $student) {
            $studentOptions[$student->student_no] = $student->student_no . ' (' . $student->last_name . ', ' . $student->first_name . ')';
        }

        return $form
            ->columns(2)
            ->schema([
                Components\Select::make('student_no')
                    ->label('Student ID and Name') // Change the label to indicate both Student ID and Last Name
                    ->placeholder('Select Student') // Change the placeholder accordingly
                    ->options($studentOptions) // Use fetched student options
                    ->searchable()
                    ->required(),
                Components\Select::make('aysem_id')
                    ->label('Ay-Sem')
                    ->placeholder('Ay-Sem')
                    ->options(Aysem::all()->pluck('id', 'id')->toArray())
                    ->required(),
            ])
            ->statePath('data');
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(Classes::query()) // Adjust the query to fetch data from the TaClass model
            ->columns([
                TextColumn::make('course.subject_code')
                    ->label('Subject Code')
                    ->formatStateUsing(function ($state, $record) {
                        return $state . '-' . $record->section;
                    }),
                TextColumn::make('course.subject_title')
                    ->label('Subject Title'),
                TextColumn::make('course.units')
                    ->label('Units'),
                TextColumn::make('grade')
                    ->label('Grades')
                    ->getStateUsing(function ($record) {
                        return '1.25';
                    }),
            ]);
    }

    public function printReport()
    {
         // Set flag to true to show the table
        $this->showTable = true;

        // Randomize the order of fetched data
        $this->getTable()->query(function () {
            return Classes::inRandomOrder();
        });
    }

    public function resetForm()
    {
        $this->form->fill([]);
        $this->data = [];

        // Reset table data by setting an empty query
        $this->getTable()->query(function () {
        return Classes::where('id', '=', null);
    });
    }
}