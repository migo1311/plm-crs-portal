<?php

namespace App\Filament\Pages;

use App\Models\Aysem;
use App\Models\TaClass;
use App\Models\Course;
use Filament\Forms\Components;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables; // Add this line
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Actions\CreateAction;

class FacultyLoading extends Page implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.faculty-loading';

    protected static ?string $navigationGroup = 'Print Forms';

    public function form(Form $form): Form
    {
        return $form->columns()->schema([
            Components\Select::make('Select')
                ->placeholder('AYSEM')
                ->options(Aysem::pluck('year')) 
                ->required(),
        ]);
    }

    public function table(Table $table): table
    {
        return $table
            ->query(TaClass::query())
            ->columns([
                TextColumn::make('course.subject_code'),
                TextColumn::make('section'),
                TextColumn::make('course.subject_title'),
                TextColumn::make('classSchedules.schedule_name'),
                TextColumn::make('instructor.instructor_code'),
                TextColumn::make('slots'),
                TextColumn::make('students_qty'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->model(TaClass::class)
                    ->label('Print')

            ]);
            

    }


}
