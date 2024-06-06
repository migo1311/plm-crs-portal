<?php

namespace App\Filament\Pages;

use App\Models\Block;
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
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Concerns\InteractsWithTable;

class Registration extends Page implements HasForms, HasTable
{
    use InteractsWithForms, InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.registration';
    protected static ?int $navigationSort = 2;

    public $showTable = false;
    public $selectedStudent, $blockStats;
    public $studentId;
    public $SelectedStudentId = false;

    public function mount()
    {
        if (!$this->studentId) {
            $this->studentId = Student::first()->student_id;
        }
    }
    

    public function form(Form $form): Form
    {
        $students = Student::all()->pluck('student_id', 'student_id')->toArray();

        return $form
            ->schema([
                Components\Select::make('student_id')
                    ->label('Student Number')
                    ->placeholder('Select Student Number')
                    ->options($students)
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn ($state) => $this->updateSelectedStudent($state['student_id'])),
            ]);
    }

    public function updateSelectedStudent($studentId)
    {
        $this->studentId = $studentId;
        $this->selectedStudent = Student::find($studentId);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(Classes::query())
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
                TextColumn::make('classSchedules.credited_units')
                    ->label('Credits'),
            ]);
    }

    public function printReport()
    {
        $this->showTable = true;
        $this->SelectedStudentId = true;
        $this->selectedStudent = Student::find($this->studentId);
        $this->blockStats = Block::where('block_id', $this->selectedStudent->block_id)->first();
    }
}