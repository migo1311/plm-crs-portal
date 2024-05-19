<?php

namespace App\Filament\Pages;

use App\Models\InstructorProfile;
use App\Models\TaClass;
use Filament\Forms\Components;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables; // Add this line

class StudyLoad extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static string $view = 'filament.pages.study-load';

    protected static ?string $navigationGroup = 'Utilities';


    public function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Components\Select::make('Faculty Name')
                    ->placeholder('Select Faculty Name')
                    ->options(InstructorProfile::pluck('faculty_name', 'college_id')) // Assuming Faculty model has 'name' and 'id' fields
                    ->required(),
                Components\TextInput::make('Study Load (Units)')
                    ->placeholder('Study Load (Units)')
                    ->required(),
                Components\TextInput::make('Outside Teaching Load (Units)')
                    ->placeholder('Outside Teaching Load (Units)')
                    ->required(),
            ]);
    }
}

