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

class FacultyRecords extends Page implements HasForms
{
    use InteractsWithForms;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.faculty-records';

    protected static ?string $navigationGroup = 'Utilities';

    public function form(Form $form): Form
    {
        return $form
            ->columns(4)
            ->schema([
                Components\Select::make('Employee Number')
                    ->required(),
                Components\TextInput::make('Last Name')
                    ->required(),
                Components\TextInput::make('First Name')
                    ->required(),
                Components\TextInput::make('Middle Name'),
                Components\TextInput::make('Maiden Name')
                    ->columnSpan(2),
                Components\Select::make('Birth Place (Province-City)'),
                Components\DatePicker::make('Birth Date')
                    ->required(),
                Components\Select::make('Pedigree')
                    ->required(),
                Components\Select::make('Gender')
                    ->options([
                        'male' => 'Male',
                        'female' => 'Female',
                        'other' => 'Other',
                    ])
                    ->required(),
                Components\Select::make('Civil Status')
                    ->required(),
                Components\Select::make('Citizenship')
                    ->required(),
                Components\TextInput::make('Mobile Phone')
                    ->required()
                    ->columnSpan(2),
                Components\TextInput::make('Email Address')
                    ->required()
                    ->columnSpan(2)
            ]);

            
            return $form
                ->columns(2)
                ->schema([
                    Components\Select::make('Tin Number')
                        ->required(),
                    Components\TextInput::make('GSIS Number')
                        ->required(),
                    Components\TextInput::make('Instructor Code')
                        ->required()
                        ->columnSpanFull()
                ]);
    }

    
}
