<?php

namespace App\Filament\Faculty\Pages;

use App\Models\Aysem;
use App\Models\TaClass;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Form;
use Filament\Forms\Components;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Pages\Page;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Support\Colors\Color;

class GradeSheet extends Page implements HasForms, HasTable
{

    use InteractsWithForms, InteractsWithTable;
    
    protected static ?string $navigationIcon = 'heroicon-o-document-check';

    protected static string $view = 'filament.faculty.pages.grade-sheet';
    
    protected static ?int $navigationsort = 3;

    public ?array $data = [];
    public $showTable = false;
    
    public function mount(): void
    {
        $this->form->fill();
    }
    
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Components\Select::make('aysem_id')
                ->label('Ay-Sem')
                ->placeholder('Ay-Sem')
                ->options(Aysem::all()->pluck('aysem_id', 'aysem_id')->toArray())
                ->required()
                ->searchable(),
            ])
            ->statePath('data');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(TaClass::query()->where('aysem_id', '=', $this->data['aysem_id']))
            ->columns([
                TextColumn::make('course.subject_code')
                    ->label('Class')
                    ->sortable(),
                TextColumn::make('section')
                    ->label('Section')
                    ->sortable(),
                TextColumn::make('course.subject_title')
                    ->label('Subject Title')
                    ->wrap(),
                TextColumn::make('classSchedules.schedule_name')
                    ->label('Schedule')
                    ->wrap(),
                TextColumn::make('instructor.instructor_code')
                    ->label('Instructor')
            ])
            
            ->actions([
                Action::make('Print')
                    ->action(function (TaClass $record) 
                    {
                        dd($record);
                    })
                    ->icon('heroicon-o-printer')
                    ->color(Color::Amber),
                Action::make('Download')
                    ->action(function (TaClass $record) 
                    {
                        dd($record);
                    })
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color(Color::Amber),
                Action::make('Input Grades')
                    ->action(function (TaClass $record) 
                    {
                        dd($record);
                    })
                    ->button()
                    ->label('Input Grades')
                    ->color(Color::Blue),
            ]);
    }
    
    public function submit(): void
    {
        $this->showTable = true;
    }
}
