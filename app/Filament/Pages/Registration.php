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
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Concerns\InteractsWithTable;

class Registration extends Page implements HasForms, HasTable
{
    use InteractsWithForms, InteractsWithTable;
    
    protected static ?string $navigationIcon = 'heroicon-o-arrow-down-on-square';
    protected static string $view = 'filament.pages.registration';
    protected static ?int $navigationsort = 2;

    public $showTable = false;
    public $selectedStudentName = '';
    public ?array $data = [];

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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(TaClass::query()) // Adjust the query to fetch data from the TaClass model
            ->columns([
                CheckboxColumn::make('selected') // Checklist column
                    ->label('Select')
                    ->sortable(),
                TextColumn::make('course.class_code')
                    ->label('Class')
                    ->formatStateUsing(function ($state, $record) {
                        return $state . '' . $record->class;
                    }),
                TextColumn::make('section')
                    ->label('Section')
                    ->sortable(),
                TextColumn::make('classSchedules.schedule_name')
                    ->label('Schedule')
                    ->sortable(),
                TextColumn::make('taClass.credited_units')
                    ->label('Credits'),
            ]);
    }

    public function printReport()
    {
        // Set flag to true to show the table
        $this->showTable = true;
    }
}