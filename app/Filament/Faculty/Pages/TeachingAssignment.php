<?php

namespace App\Filament\Faculty\Pages;

use Filament\Navigation\NavigationItem;
use App\Models\InstructorProfile;
use App\Models\TaClass;
use Filament\Pages\Page;
use Filament\Forms\Form;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Components;
use Filament\Tables\Table;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Columns\TextColumn;

class TeachingAssignment extends Page implements HasForms, HasTable
{
    use InteractsWithForms, InteractsWithTable;
    protected static ?string $navigationIcon = 'heroicon-o-document-magnifying-glass';

    protected static string $view = 'filament.faculty.pages.teaching-assignment';

    protected static ?int $navigationsort = 2;
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
            TextColumn::make('final_grade')
                ->label('Grades'),
            TextColumn::make('classSchedules.schedule_name')
                ->wrap()
                ->label('Schedule'),
            TextColumn::make('students_qty')
                ->label('No. of Students'),
            TextColumn::make('credited_units')
                ->label('Credited Units'),
            TextColumn::make('instructor.college.college_code')
                ->label('College'),
            TextColumn::make('designation.type_load')
                ->label('Type of Load'),
            ]);
    }
    public function printReport()
    {
        // Set flag to true to show the table
        $this->showTable = true;
    }
}