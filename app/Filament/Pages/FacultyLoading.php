<?php

namespace App\Filament\Pages;

use App\Models\Aysem;
use App\Models\TaClass;
use Filament\Forms;
use Filament\Pages\Page;
use Filament\Tables;

class FacultyLoading extends Page implements Forms\Contracts\HasForms, Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    use Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.faculty-loading';

    protected static ?string $navigationGroup = 'Print Forms';

    public $selectedAysem;

    public function mount()
    {
        $this->selectedAysem = null; // Initialize with null or a default value
    }

    protected function getFormSchema(): array
    {
        $aysems = Aysem::pluck('year', 'aysem_id')->toArray();

        return [
            Forms\Components\Select::make('selectedAysem')
                ->options($aysems)
                ->label('Select AYSEM')
                ->required()
                ->reactive()
                ->afterStateUpdated(fn ($state) => $this->selectedAysem = $state),
        ];
    }

    protected function getTableQuery()
    {
        $query = TaClass::with(['course', 'classSchedules', 'instructor']);

        if ($this->selectedAysem) {
            $query->where('aysem_id', $this->selectedAysem);
        }

        return $query;
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('course.subject_code')
                ->label('Subject Code')
                ->sortable(),
            Tables\Columns\TextColumn::make('section')
                ->label('Section')
                ->sortable(),
            Tables\Columns\TextColumn::make('course.subject_title')
                ->label('Subject Title')
                ->sortable(),
            Tables\Columns\TextColumn::make('classSchedules.schedule_name')
                ->label('Schedule Name')
                ->sortable(),
            Tables\Columns\TextColumn::make('instructor.instructor_code')
                ->label('Instructor Code')
                ->sortable(),
            Tables\Columns\TextColumn::make('slots')
                ->label('Slots')
                ->sortable(),
            Tables\Columns\TextColumn::make('students_qty')
                ->label('Students Quantity')
                ->sortable(),
        ];
    }
}
