<?php

namespace App\Filament\Pages;

use App\Models\Aysem;
use App\Models\Classes;
use Filament\Pages\Page;
use Filament\Forms\Components;
use Filament\Forms\Form;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Table;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Filters\SelectFilter;

class FacultyLoading extends Page implements HasForms, HasTable
{
    use InteractsWithForms, InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static string $view = 'filament.pages.faculty-loading';

    protected static ?string $navigationGroup = 'Print Forms';

    public $showTable = true;

    public ?array $data = [];

    public ?int $selectedAysemId = null;

    public function mount(): void {

        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->columns()
            ->schema([
                Components\Select::make('aysem_id')
                    ->label('Select')
                    ->placeholder('AYSEM')
                    ->options(Aysem::all()->pluck('academic_year_sem', 'id')->toArray())
                    ->required(),
            ])->statePath('data');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Classes::query())
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
            ])
            ->filters([
                SelectFilter::make('aysem')
                    ->relationship('aysem', 'id')
                    ->searchable()
            ]);
    }

    public function printReport()
    {
        if (isset($this->data['aysem_id'])) {
            $this->selectedAysemId = $this->data['aysem_id'];
            $this->showTable = true; // Show table when aysem_id is selected
        } else {
            // Handle the case where aysem_id is not set
            // You can set a default value or show an error message
            $this->selectedAysemId = null;
            $this->showTable = false;
            // Optionally, add some error handling logic here
        } 
    }
}