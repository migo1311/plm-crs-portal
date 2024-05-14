<?php

namespace App\Filament\Pages;
use Filament\Forms\Components;
use Filament\Forms\Form;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables; // Add this line
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Radio;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\ToggleButtons;


use Filament\Pages\Page;

class Statistics extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.statistics';

    protected static ?string $navigationGroup = 'Utilities';

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
             
                Select::make('AYSEM')
                    ->label('AYSEM')
                    ->placeholder('Select AYSEM')
                    ->options([
                        '20211' => '20211',
                        '20212' => '20212',
                        '20213' => '20213',
                        '20221' => '20221',
                        '20222' => '20222',
                        '20223' => '20223',
                        '20231' => '20231',
                        '20232' => '20232',
                        '20233' => '20233',
                    ])
                    ->required(),
                Radio::make('Data Set')
                    ->label('Select Data Set')
                    ->inline()
                    ->inlineLabel(false)
                    ->options([
                        'Students per course' => 'Students per course',
                        'Gender per course' => 'Gender per course',
                        'Students per year level' => 'Students per year level',
                        'Gender per year level' => 'Gender per year level',
                    ])
                    ->required(),
                Radio::make('Chart Type')
                    ->label('Select Chart Type')
                    ->inline()
                    ->inlineLabel(false)
                    ->options([
                        'Bar' => 'Bar',
                        'Line' => 'Line',
                        'Pie' => 'Pie',
                    ])
                    ->required(),
                Checkbox::make('Include table of data'),

            ])
            ->statePath('data');
    }


   
    public function create(): void
    {
        dd($this->form->getState());
    }
}
