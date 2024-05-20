<?php

namespace App\Filament\Pages;

use App\Models\Aysem;
use App\Models\InstructorProfile;
use App\Models\TaClass;
use App\Models\College;
use Filament\Pages\Page;
use Filament\Forms\Components;
use Filament\Forms\Components\Actions;
use Filament\Forms\Form;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Table;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Actions\EditAction;

class TeachingAssignment extends Page implements HasForms, HasTable
{
    use InteractsWithForms, InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.teaching-assignment';

    protected static ?string $navigationGroup = 'Print Forms';

    public $showTable = false;

    public function form(Form $form): Form
    {
        return $form
            ->columns()
            ->schema([
                Components\Select::make('instructor.faculty_name')
                    ->label('Faculty Name')
                    ->placeholder('Select Faculty')
                    ->options(InstructorProfile::all()->pluck('faculty_name', 'faculty_name')->toArray())
                    ->searchable()
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
            TextColumn::make('schedule')
                ->label('Schedule'),
            TextColumn::make('students_qty')
                ->label('No. of Students'),
            TextColumn::make('credited_units')
                ->label('Credited Units'),
            TextColumn::make('college.college_code')
                ->label('College'),
            TextColumn::make('designation.type_load')
                ->label('Type of Load'),
        ])
        ->actions([
                EditAction::make(),
        ]);
}

    public function printReport()
    {
        // Set flag to true to show the table
        $this->showTable = true;
    }
}
