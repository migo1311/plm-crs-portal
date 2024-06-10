<?php

namespace App\Filament\Pages;

use Filament\Tables;
use App\Models\Classes;
use App\Models\Student;
use Filament\Tables\Contracts\HasTable;
use Filament\Pages\Page;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Model;

class PrintGradeSheet extends Page implements HasTable
{
    use InteractsWithTable;
    protected static ?string $navigationIcon = 'heroicon-o-folder-arrow-down';

    protected static string $view = 'filament.pages.print-grade-sheet';

    protected static ?string $navigationGroup = 'Student Affairs';

    public ?array $array = [];
    public $showTable = true;

    public function table(Table $table): Table
    {
        return $table
            ->query($this->getFilteredQuery())
            ->columns([
                TextColumn::make('full_name')
                    ->label('Student Name'),
                TextColumn::make('student_no')
                    ->label('Student No.')
                    ->formatStateUsing(function ($state, $record) {
                        return $state;
                    }),
                TextColumn::make('classes.course.subject_code')
                    ->label('Course'),
                TextColumn::make('studentTerms.year_level')
                    ->label('Year')
                    ->sortable(),
                TextColumn::make('grades.grade')
                    ->label('Grade')
                    ->sortable(),
                TextColumn::make('grades.remarks')
                    ->label('Remarks')
                    ->sortable(),
            ])
            ->filters([
				SelectFilter::make('student_no')
                    ->relationship('student', 'student_no')
                    ->searchable(),
              	SelectFilter::make('last name')
                    ->relationship('student', 'last_name')
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
        $query = Student::query();

        if (isset($this->array['student_no'])) {
            $query->where('student_no', $this->array['student_no']);
        }

        if (isset($this->array['last_name'])) {
            $query->whereHas('student', function ($q) {
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
