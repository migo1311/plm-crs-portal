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
use Filament\Forms\Get;
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

    public function mount()
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        $user = Auth::user()->name;
        $instructor = Instructor::where('instructor_code', $user)->first();
        $classes = Classes::whereHas('instructor', function($query) use ($instructor) {
            $query->where('instructor_id', $instructor->id);
        })->get();

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
                        $aysemOption = [];
    
                        if ($get('aysem') === 'Current') {
                            $maxAysemId = $classes->max('aysem_id');
                            if ($maxAysemId) {
                                $aysemOption[$maxAysemId] = $maxAysemId;
                            }
                        } else {
                            $otherClasses = $classes->where('aysem_id', '!=', $classes->max('aysem_id'));
                            $aysemOption = $otherClasses->pluck('aysem_id', 'aysem_id')->toArray();
                        }
    
                        return $aysemOption ?: ['' => 'No Academic Year Available'];
                    })
                    ->default('Current')
                    ->live()
                    ->required()->columns(1),
            ])->statePath('data');
    }

    public function table(Table $table): Table
    {
        $user = Auth::user()->name;
        $instructor = Instructor::where('instructor_code', $user)->first();

        return $table
            ->query(Classes::query()->whereHas('instructor', function($query) use ($instructor) {$query->where('instructor_id', $instructor->id);
            })->where('aysem_id', $this->data['academic_year_code']))
            ->columns([
                TextColumn::make('course.subject_code')
                    ->label('Subject Code')
                    ->formatStateUsing(function ($state, $record) {
                        return $state ;
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
