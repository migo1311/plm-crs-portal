<?php

namespace App\Filament\Pages;

use Filament\Tables;
use App\Models\Instructor;
use App\Models\Aysem;
use App\Models\Classes;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components;
use Filament\Pages\Page;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Filters\SelectFilter;
use Livewire\WithPagination;

class PrintClassList extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static string $view = 'filament.pages.print-class-list';

    protected static ?string $navigationGroup = 'Student Affairs';

    public ?array $array = [];
    public $showTable = true;

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

    public function printReport()
    {
        // Set flag to true to show the table
        $this->showTable = true;
    }
}
