<?php

namespace App\Filament\Pages;

use App\Models\Aysem;
use App\Models\Student;
use App\Models\Assessment;
use Filament\Pages\Page;
use Filament\Forms\Components;
use Filament\Forms\Form;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;

class PrintAssessmentForm extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.print-assessment-form';
    protected static ?string $navigationGroup = 'Print Forms';

    public $studentId;
    public $aysem;
    public $showDetails = false;
    public $assessment;

    public function mount()
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        // Fetch the list of available academic year/semesters
        $aysems = Aysem::all()->pluck('id');

        return $form
            ->schema([
                Components\Grid::make()
                    ->columns(2)
                    ->schema([
                        Components\TextInput::make('studentId')
                            ->label('Student Number')
                            ->placeholder('Enter Student Number')
                            ->required()
                            ->reactive(),
                        
                        Components\Select::make('aysem')
                            ->label('Academic Year/Semester')
                            ->placeholder('Select Academic Year/Semester')
                            ->options($aysems)
                            ->required()
                            ->reactive(),
                    ]),
            ]);
    }


    public function submitForm()
    {
        $this->showDetails = true;

        // Load the assessment data based on studentId and aysem
        $this->assessment = Assessment::where('student_no', $this->studentId)
            ->where('aysem_id', $this->aysem)
            ->first();
    }
}


