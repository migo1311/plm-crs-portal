<?php

namespace App\Filament\Faculty\Pages;

use App\Models\Aysem;
use App\Models\Classes;
use Filament\Pages\Page;
use Filament\Forms\Components;
use Filament\Forms\Form;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Table;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Carbon\Carbon;

class ClassAssignments extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static string $view = 'filament.faculty.pages.class-assignments';
    
    protected static ?int $navigationsort = 1;

    public $showTable = true; // Show table by default
    public $aysem_id = 'Current';
    
    public $academic_year_code;// Default to 'Current'

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Components\Select::make('academic_year_code')
                    ->label('')
                    ->placeholder('AYSEM')
                    ->options(['Current' => 'Current', 'Previous' => 'Previous'])
                    ->default('Current')
                    ->reactive() // Make it reactive to update the table on change
                    ->afterStateUpdated(fn () => $this->resetTable()), // Reset the table to refresh data
            ]);
    }

    protected function getTableQuery()
    {
        $query = Aysem::query();

        if ($this->academic_year_code === 'Current') {
            // Apply filter for current schedule
            // Assuming 'date' is the column used to determine current classes
            $query->where('date_start', '>=', Carbon::now()->startOfYear());
        } else if ($this->academic_year_code === 'Previous') {
            // Apply filter for previous schedule
            $query->where('date_end', '<', Carbon::now()->startOfYear());
        }

        return $query;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(fn () => $this->getTableQuery())
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
                TextColumn::make('classSchedule.schedule_name')
                    ->label('Schedule')
                    ->sortable(),
                TextColumn::make('students_qty')
                    ->label('No. of Students')
                    ->sortable(),
                TextColumn::make('instructors.faculty_name')
                    ->label('Faculty')
                    ->sortable(),
            ]);
    }

    protected function resetTable()
    {
        $this->emit('refreshTable'); // Emit event to refresh the table
    }
}
