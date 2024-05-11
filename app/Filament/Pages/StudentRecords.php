<?php

namespace App\Filament\Pages;

use App\Models\Student;
use Filament\Forms\Components;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;

class StudentRecords extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.student-records';

    protected static ?string $navigationGroup = 'Utilities';

    public function form(Form $form): Form
    {
        return $form
            ->columns(4)
            ->schema([
                // First form fields
                Components\TextInput::make('Student ID')
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
            ])
            ->columns(4)
            ->schema([
                // Second form fields
                Components\TextInput::make('Tin Number')
                    ->required(),
                Components\TextInput::make('SSS Number')
                    ->required(),
                Components\TextInput::make('Student Code')
                    ->required()
                    ->columnSpanFull(),
                Components\Select::make('Program')
                    ->required(),
                Components\Select::make('Year Level')
                    ->options([
                        '1st' => '1st',
                        '2nd' => '2nd',
                        '3rd' => '3rd',
                        '4th' => '4th',
                        '5th' => '5th',
                    ])
                    ->required(),
                Components\Select::make('Section')
                    ->options([
                        'A' => 'A',
                        'B' => 'B',
                        'C' => 'C',
                        'D' => 'D',
                    ])
                    ->required(),
                Components\Select::make('Shift')
                    ->options([
                        'Morning' => 'Morning',
                        'Afternoon' => 'Afternoon',
                    ])
                    ->required(),
            ]);
    }
}
