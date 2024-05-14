<?php

namespace App\Filament\Pages;

use App\Models\Student;
use Filament\Pages\Page;
use Filament\Forms\Form;
use Filament\Forms\Components;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class Registration extends Page implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.registration';

    protected static ?int $navigationsort = 2;


    public function mount(): void
    {
        $this->form->fill();
    }
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('Student Number')
                    ->required(),
                // ...
            ])
            ->statePath('data');
    }

    public function table (Table $table): Table
    {
        return $table
            ->columns([
                // ...
            ])
            ->filters([
                // ...
            ]);
    }
    
    public function create(): void
    {
        dd($this->form->getState());
    }
}