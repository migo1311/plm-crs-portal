<?php

namespace App\Filament\Pages;

use Filament\Tables;
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
use Filament\Tables\Filters\SelectFilter;
use Livewire\WithPagination;

class PrintClassList extends Page implements HasForms, HasTable
{
    use InteractsWithForms, InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.print-class-list';

    protected static ?string $navigationGroup = 'Forms';

    public ?array $array = [];
    public $showTable = true;

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
                    ->placeholder('Select year-sem')
                    ->options(Aysem::all()->pluck('academic_year_sem', 'id')->toArray())
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
            ->query($this->getFilteredQuery())
            ->columns([
                TextColumn::make('course.subject_code')
                    ->label('Subject Code')
                    ->formatStateUsing(function ($state, $record) {
                        return $state;
                    }),
                
                TextColumn::make('course.subject_title')
                    ->label('Subject Title'),
                TextColumn::make('course.units')
                    ->label('Units')
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
                    ->relationship('aysem', 'academic_year_sem')
                    ->searchable(),
              	SelectFilter::make('last name')
                    ->relationship('instructor', 'last_name')
                    ->searchable()
            ])
          	->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ]);
    }

    protected function getFilteredQuery()
    {
        $query = Classes::query();

        if (isset($this->array['aysem_id'])) {
            $query->where('aysem_id', $this->array['aysem_id']);
        }

        if (isset($this->array['last_name'])) {
            $query->whereHas('instructor', function ($q) {
                $q->where('last_name', $this->array['last_name']);
            });
        }

        return $query;
    }

    public function search()
    {
        // Set flag to true to show the table
        $this->showTable = true;
    }
    
    public function printTable()
    {
        $this->emit('printTable');
    }
}
