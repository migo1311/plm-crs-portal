<?php

namespace App\Filament\Pages;

use App\Models\Student;
use Filament\Pages\Page;
use Filament\Forms\Components;
use Filament\Forms\Form;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Select;
use Filament\Tables; // Add this line

class StudentInformation extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.student-information';

    protected static ?string $navigationGroup = 'Utilities';

    public function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Components\TextInput::make('ay-sem')
                ->schema([
                    Components\TextInput::make('ay-sem')
                    ->label('Select Ay-Sem')
                    ->required(),
                    ]),
                 Components\Section::make('Fields to be Included')
                 ->schema([
                    Components\Select::make('Field Selection')
                    ->multiple()
                    ->options([
                        'plm email address' => 'Plm Email Address',
                        'email address' => 'Email Address',
                        'birthdate' => 'Birthdate',
                        'birthplace' => 'BirthPlace',
                        'age' => 'Age',
                        'gender' => 'Gender',
                        'civil status' => 'Civil Status',
                        'mobile number' => 'Mobile Number',
                        'religion' => 'Religion',
                        'height' => 'Height',
                        'complexion' => 'Complexion',
                        ])
                        ->required(),
                    ]),
            ])
            ->statePath('data');
    }
}
