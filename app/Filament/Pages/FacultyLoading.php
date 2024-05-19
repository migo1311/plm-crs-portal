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

class FacultyLoading extends Page implements HasForms, HasTable
{
    use InteractsWithForms, InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.faculty-loading';

    protected static ?string $navigationGroup = 'Print Forms';

    public $showTable = false;

    public function form(Form $form): Form
    {
        return $form
            ->columns()
            ->schema([
                Components\Select::make('aysem_id')
                    ->label('Select')
                    ->placeholder('AYSEM')
                    ->options(Aysem::all()->pluck('aysem_id', 'aysem_id')->toArray())
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(TaClass::query())
            ->columns([
                TextColumn::make('course.subject_code')
                    ->label('Subject Code')
                    ->formatStateUsing(function ($state, $record) {
                        return $state . '-' . $record->section;
                    }),
                TextColumn::make('section')
                    ->label('Section')
                    ->sortable(),
                TextColumn::make('course.subject_title')
                    ->label('Subject Title'),
                TextColumn::make('course.units')
                    ->label('Units')
                    ->sortable(),
                TextColumn::make('classSchedules.schedule_name')
                    ->label('Schedule')
                    ->sortable(),
                TextColumn::make('students_qty')
                    ->label('No. of Students')
                    ->sortable(),
                TextColumn::make('instructor.faculty_name')
                    ->label('Faculty')
                    ->sortable(),
            ]);
    }

    public function printReport()
    {
        // Set flag to true to show the table
        $this->showTable = true;
    }
}