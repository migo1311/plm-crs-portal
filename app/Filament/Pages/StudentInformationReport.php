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
use Livewire\Component;

class StudentInformationReport extends Page implements HasForms, HasTable
{
    use InteractsWithForms, InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.student-information-report';
    protected static ?string $navigationGroup = 'Print Forms';

    public $showTable = false;

    public function form(Form $form): Form
    {
        return $form
            ->columns(2)
            ->schema([
                Components\Select::make('student_number')
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

    public function table(Table $table): Table
    {
        return $table
            ->query(TaClass::query()) // Ensure it fetches the correct data
            ->columns([
                TextColumn::make('course.subject_code')
                    ->label('Subject Code')
                    ->formatStateUsing(function ($state, $record) {
                        return $state . '-' . $record->section;
                    })
                    ->sortable(),
                TextColumn::make('section')
                    ->label('Section')
                    ->sortable(),
                TextColumn::make('course.subject_title')
                    ->label('Subject Title'),
                TextColumn::make('course.units')
                    ->label('Units'),
                TextColumn::make('classSchedules.schedule_name')
                    ->label('Schedule'),
                TextColumn::make('instructor.faculty_name')
                    ->label('Faculty')
            ]);
    }

    public function printReport()
    {
        // Set flag to true to show the table
        $this->showTable = true;
    }
}
