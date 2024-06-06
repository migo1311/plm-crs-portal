<?php

namespace App\Filament\Pages;

use App\Models\Instructor;
use App\Models\Aysem;
use App\Models\Classes;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Form;
use Filament\Forms\Components;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Pages\Page;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;

class PrintClassList extends Page implements HasForms, HasTable
{
    use InteractsWithForms, InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.print-class-list';

    protected static ?string $navigationGroup = 'Print Forms';

    public ?array $array = [];
    public $showTable = false;

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->columns(2)
            ->schema([
                Components\Select::make('aysem_id')
                    ->label('Aysem')
                    ->placeholder('Select year-sem (e.g., 20211)')
                    ->options(Aysem::all()->pluck('id', 'id')->toArray())
                    ->searchable()
                    ->required(),
                Components\Select::make('last_name')
                    ->label('Surname')
                    ->options(Instructor::all()->pluck('last_name', 'last_name')->toArray())
                    ->searchable()
                    ->required(),
            ])->statePath('array');
    }

    public function table(Table $table): Table
    {
    return $table
        ->query(Classes::query()->where('aysem_id', '=', $this->array['aysem_id']))
        ->columns([
            TextColumn::make('course.subject_code')
                ->label('Subject Code'),
            TextColumn::make('section')
                ->label('Section'),
            TextColumn::make('classSchedules.schedule_name')
                ->label('Schedule'),
            TextColumn::make('slots'),
            TextColumn::make('enlisted'),
        ])
        ->actions([
            
        ]);
}

    public function search()
    {
        // Set flag to true to show the table
        $this->showTable = true;
    }
}
