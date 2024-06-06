<?php

namespace App\Filament\Pages;

use App\Models\InstructorProfile;
use App\Models\Designation;
use App\Models\FacultyDesignation as FacultyDesignationModel;
use App\Models\Instructor;
use Filament\Forms\Form;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class FacultyDesignation extends Page implements HasForms
{
    use InteractsWithForms;
    
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static string $view = 'filament.pages.faculty-designation';
    protected static ?string $navigationGroup = 'Utilities';

    public $instructor_id;
    public $designation_id;
    public $schedule;
    public ?array $data = [];

    public function mount()
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Components\Select::make('instructor_id')
                ->label('Select Faculty Name')
                ->placeholder('Select Option')
                ->options(Instructor::pluck('faculty_name', 'id')->toArray())
                ->required(),   
                Components\Select::make('designation_id')
                    ->label('Select New Designation')
                    ->placeholder('Select Option')
                    ->options(Designation::pluck('title', 'id')->toArray())
                    ->searchable()
                    ->required(),
                Components\TextInput::make('schedule')
                    ->label('Enter New Schedule')
                    ->required(),
            ])
            ->statePath('data');
    }

    public function save()
    {
        
        $userId = Auth::id(); // Get the ID of the authenticated user
    
        FacultyDesignationModel::create([
            'instructor_id' => $this->data['instructor_id'],
            'designation_id' => $this->data['designation_id'],
            'schedule' => $this->data['schedule'],
            'update_by' => $userId,  // Set the 'update_by' field to the authenticated user's ID
            'is_active' => true,     // Automatically set 'is_active' to true
        ]);

        session()->flash('success', 'Faculty designation updated successfully.');
        $this->resetForm();
    }
    
    protected function resetForm()
    {
        $this->form->fill([]);
    }
}
