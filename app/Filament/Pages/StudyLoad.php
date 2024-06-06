<?php

namespace App\Filament\Pages;

use App\Models\Aysem;
use App\Models\Instructor;
use Filament\Forms\Components;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\StudyLoad as StudyLoadModel;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;

class StudyLoad extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static string $view = 'filament.pages.study-load';

    protected static ?string $navigationGroup = 'Utilities';

    public $instructor_id;
    public $study_units;
    public $teaching_units;


    public function mount()
    {
        $this->form->fill([]);
    }

    protected function getFormModel(): string
    {
        return StudyLoadModel::class;
    }

    public function form(Form $form): Form
    {
        return $form
        ->columns(1)
        ->schema([
            Components\Select::make('instructor_id')
                ->label('Select Faculty Name')
                ->options(Instructor::pluck('faculty_name', 'id')) // Assuming Faculty model has 'name' and 'id' fields
                ->required(),
            Components\TextInput::make('study_units')
                ->placeholder('Study Load (Units)')
                ->maxLength(2)
                ->required(),
            Components\TextInput::make('teaching_units')
                ->placeholder('Outside Teaching Load (Units)')
                ->maxLength(2)
                ->required(),
        ]);
    }

    public function save()
    {
        $data = $this->form->getState();
        $userId = Auth::id(); // Get the ID of the authenticated user
        StudyLoadModel::create([
            'instructor_id' => $data['instructor_id'],
            'study_units' => $data['study_units'],
            'teaching_units' => $data['teaching_units'],
            'aysem_id' => Aysem::all()->last()->getAttributeValue('id'),
            'entered_by' => $userId,
            'entered_on' => now() // Set the 'entered_by' field to the authenticated user's ID
        ]);

        session()->flash('success', 'Faculty Load submitted.');
    }

}