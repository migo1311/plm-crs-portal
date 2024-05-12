<?php

namespace App\Filament\Pages;

use App\Models\InstructorProfile;
use App\Models\Course;
use App\Models\TaClass;
use Filament\Forms\Components;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables; // Add this line

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
                    ->options(InstructorProfile::pluck('faculty_name')) // Assuming Faculty model has 'name' and 'id' fields
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
}
