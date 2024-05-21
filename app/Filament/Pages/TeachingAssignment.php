<?php

namespace App\Filament\Pages;

use App\Models\InstructorProfile;
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
use Filament\Tables\Actions\EditAction as ActionsEditAction;
use Filament\Forms\Components\Wizard\Step;
use Illuminate\Database\Eloquent\Model;

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
            TextColumn::make('final_grade')
                ->label('Grades'),
            TextColumn::make('classSchedules.schedule_name')
                ->label('Schedule'),
            TextColumn::make('students_qty')
                ->label('No. of Students'),
            TextColumn::make('credited_units')
                ->label('Credited Units'),
            TextColumn::make('college.college_name')
                ->label('College'),
            TextColumn::make('designation.type_load')
                ->label('Type of Load'),
        ])
        ->actions([
            ActionsEditAction::make()
            ->modalHeading('Edit Teaching Assignment')
            ->steps([
                Step::make('Class Information')
                    ->model(TaClass::class)
                    ->columns(4)
                    ->schema([
                        Components\TextInput::make('class_id')
                            ->label('Class ID')
                            ->hidden(),
                        Components\TextInput::make('course.subject_code')
                            ->label('Subject Code')
                            ->required(),  
                        Components\TextInput::make('course.subject_title')
                            ->label('Subject Title')
                            ->required(),
                        Components\TextInput::make('course.units')
                            ->label('Units')
                            ->required(),
                        Components\TextInput::make('final_grade')
                            ->label('Grades')
                            ->required(),
                        Components\TextInput::make('classSchedules.schedule_name')
                            ->label('Schedule')
                            ->required(),
                        Components\TextInput::make('students_qty')
                            ->label('No. of Students')
                            ->required(),
                        Components\TextInput::make('credited_units')
                            ->label('Credited Units')
                            ->required(),
                        Components\TextInput::make('college.college_name')
                            ->label('College')
                            ->required(),
                        Components\TextInput::make('designation.type_load')
                            ->label('Type of Load')
                            ->required(),
                    ])
            ])
            ->using(function (array $data, Model $record) {

                // dd(session()->get('class_id'));
                $record->update($data);
            })
        ]);
}

    public function printReport()
    {
        // Set flag to true to show the table
        $this->showTable = true;
    }
}
