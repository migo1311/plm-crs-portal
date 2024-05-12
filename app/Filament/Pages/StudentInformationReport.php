<?php

namespace App\Filament\Pages;

use App\Models\Student;
use Filament\Pages\Page;
use Filament\Forms\Components;
use Filament\Forms\Form;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables; // Add this line

class StudentInformationReport extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.student-information-report';

    protected static ?string $navigationGroup = 'Print Forms';

    public function form(Form $form): Form
    {
        return $form
            ->columns(2)
            ->schema([
                Components\Select::make('student Number')
                    ->placeholder('Select Student Number')
                    ->options(Student::all()->pluck('student_id', 'student_id')->toArray())// Assuming Faculty model has 'name' and 'id' fields
                    ->searchable()
                    ->required(),
                Components\TextInput::make('ay-sem')
                    ->placeholder('Ay-Sem')
                    ->required(),
            ]);
    }
}
