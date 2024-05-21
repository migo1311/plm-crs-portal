<?php

namespace App\Filament\Pages;

use App\Models\Aysem;
use App\Models\Student;
use Filament\Pages\Page;
use Filament\Forms\Components;
use Filament\Forms\Form;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;

class PrintAssessmentForm extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.print-assessment-form';

    protected static ?string $navigationGroup = 'Print Forms';

    public function form(Form $form): Form
    {
        return $form
            ->columns(2)
            ->schema([
                Components\Select::make('student_id')
                    ->label('Student Number')
                    ->placeholder('Select Student Number')
                    ->options(Student::all()->pluck('student_id', 'student_id')->toArray())
                    ->searchable()
                    ->required(),
                Components\Select::make('aysem_id')
                    ->label('Ay-Sem')
                    ->placeholder('Ay-Sem')
                    ->options(Aysem::all()->pluck('aysem_id', 'aysem_id')->toArray())
                    ->required(),
            ]);
    }
}