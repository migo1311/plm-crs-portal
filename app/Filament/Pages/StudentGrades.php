<?php

namespace App\Filament\Pages;

use App\Models\Aysem;
use App\Models\TaClass;
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

    public $showTable = false;
    public $selectedStudentName = '';

    public function form(Form $form): Form
    {
        return $form
            ->columns(2)
            ->schema([
                Components\Select::make('student_id')
                    ->label('Student Number')
                    ->placeholder('Select Student Number')
                    ->options(Student::all()->pluck('student_id', 'student_id')->toArray())
                    ->searchable()
                    ->required(),
                Components\Select::make('aysem_id')
                    ->label('Ay-Sem')
                    ->placeholder('Ay-Sem')
                    ->options(Aysem::all()->pluck('aysem_id', 'aysem_id')->toArray())
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(TaClass::query()) // Adjust the query to fetch data from the TaClass model
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
                TextColumn::make('grade.final_grade')
                    ->label('Grades'),
            ]);
    }

    public function printReport()
    {
        // Set flag to true to show the table
        $this->showTable = true;
    }
}
