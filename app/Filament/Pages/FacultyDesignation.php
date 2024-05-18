<?php

namespace App\Filament\Pages;

use App\Models\InstructorProfile;
use App\Models\Course;
use Filament\Forms\Components;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;

class FacultyDesignation extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.faculty-designation';
    protected static ?string $navigationGroup = 'Utilities';

    public function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Components\Select::make('Select Faculty Name')
                    ->placeholder('Select Option')
                    ->options(InstructorProfile::pluck('faculty_name'))
                    ->required(),
                Components\Select::make('Select New Designation')
                    ->placeholder('Select Option')
                    ->options(Course::pluck('subject_title'))
                    ->required(),
                Components\TextInput::make('Enter New Schedule')
                    ->placeholder('')
                    ->required(),
            ]);
    }

    public function update(Form $form)
    {
        // Validate form input
        $validatedData = $form->validate([
            'Select Faculty Name' => 'required',
            'Select New Designation' => 'required',
            'Enter New Schedule' => 'required',
        ]);

        // Save the form data to the database
        FacultyDesignation::create([
            'faculty_name' => $validatedData['Select Faculty Name'],
            'new_designation' => $validatedData['Select New Designation'],
            'new_schedule' => $validatedData['Enter New Schedule'],
        ]);

        // Optionally, you can add a success message or redirect the user to a different page
        // For example:
        // session()->flash('success', 'Faculty designation updated successfully.');
        // return redirect()->route('your.route.name');
    }
}
