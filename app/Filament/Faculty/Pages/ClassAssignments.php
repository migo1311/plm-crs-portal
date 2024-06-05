<?php

namespace App\Filament\Faculty\Pages;

use App\Models\Aysem;
use App\Models\Classes;
use App\Models\Instructor;
use Filament\Pages\Page;
use Filament\Forms\Components;
use Filament\Forms\Form;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Table;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ClassAssignments extends Page implements HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static string $view = 'filament.faculty.pages.class-assignments';
    
    protected static ?int $navigationsort = 1;

    public $showTable = false; // Show table by default
    public $latestAysem = 'Current';
    public ?array $data = [];
    
    public $academic_year_code;// Default to 'Current'

    public function form(Form $form): Form
    {$user = Auth::user()->name;
        $instructor = Instructor::where('instructor_code', $user)->first();
        $classes = Classes::with('instructor')->get()->where('instructor_id', $instructor->instructor_id);

        return $form
            ->columns(2)
            ->schema([
                Components\Select::make('aysem')
                    ->label('')
                    ->placeholder('AYSEM')
                    ->options([ 'Current' => 'Current', 'Previous' => 'Previous'])
                    ->default('Current')
                    ->live()->columns(1),
                Components\Select::make('academic_year_code')
                    ->label('')
                    ->placeholder('Academic Year')
                    ->options(function ($get) use ($classes) {
                        if ($get('aysem')=== 'Current') {
                            return [$classes->max('aysem_id') => $classes->max('aysem_id')];
                        } else {
                            $otherClasses = $classes->where('aysem_id', '!=', $classes->max('aysem_id'));
                            return $otherClasses->pluck('aysem_id', 'aysem_id')->toArray();
                        }
                    })
                    ->default('Current')
                    ->live()
                    ->required()->columns(1),
            ])->statePath('data');
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

    public function submit()
    {
        $this->showTable = true;
    }
}
