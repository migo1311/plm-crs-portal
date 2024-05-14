<?php

namespace App\Filament\Pages;

use App\Models\Student;
use Filament\Pages\Page;
use Filament\Forms\Components;
use Filament\Forms\Form;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Table;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Livewire\Component;

class StudentInformationReport extends Page implements HasForms, HasTable
{
    use InteractsWithForms, InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.student-information-report';
    protected static ?string $navigationGroup = 'Print Forms';

    public $showTable = false;

    public function form(Form $form): Form
    {
        return $form
            ->columns(2)
            ->schema([
                Components\Select::make('student_number')
                    ->label('Student Number')
                    ->placeholder('Select Student Number')
                    ->options(Student::all()->pluck('student_id', 'student_id')->toArray())
                    ->searchable()
                    ->required(),
                Components\TextInput::make('ay_sem')
                    ->label('Ay-Sem')
                    ->placeholder('Ay-Sem')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Student::query()) // Add this line to specify the data source
            ->columns([
                TextColumn::make('subject_code')->label('Subject Code'),
                TextColumn::make('section')->label('Section'),
                TextColumn::make('subject_title')->label('Subject Title'),
                TextColumn::make('units')->label('Units'),
                TextColumn::make('schedule')->label('Schedule'),
                TextColumn::make('faculty')->label('Faculty'),
            ]);
    }

    public function printReport()
    {
        // Set flag to true to show the table
        $this->showTable = true;
    }
}
