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

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.registration';
    protected static ?int $navigationSort = 2;

    public $showTable = false;
    public $selectedStudentName = '';
    public $selectedStudent;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Components\Select::make('student_id')
                    ->label('Student Number')
                    ->placeholder('Select Student Number')
                    ->options(Student::all()->pluck('student_id', 'student_id')->toArray())
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn ($state) => $this->updateSelectedStudent($state)),
            ]);
    }

    protected function updateSelectedStudent($studentId)
    {
        $this->selectedStudent = Student::find($studentId);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(TaClass::query())
            ->columns([
                CheckboxColumn::make('selected')
                    ->label('Select')
                    ->sortable(),
                TextColumn::make('course.class_code')
                    ->label('Class')
                    ->formatStateUsing(fn ($state, $record) => $state . ' ' . $record->class),
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
        $this->showTable = true;
    }
}
