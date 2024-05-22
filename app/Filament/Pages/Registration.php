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
                CheckboxColumn::make('selected') // Checklist column
                    ->label('Select')
                    ->sortable(),
                TextColumn::make('course.class_code')
                    ->label('Class')
                    ->formatStateUsing(function ($state, $record) {
                        return $state . '' . $record->class;
                    }),
                TextColumn::make('section')
                    ->label('Section')
                    ->sortable(),
                TextColumn::make('classSchedules.schedule_name')
                    ->wrap()
                    ->label('Schedule')
                    ->sortable(),
                TextColumn::make('credited_units')
                    ->label('Credits'),
            ]);
    }

    public function printReport()
    {
        // Set flag to true to show the table
        $this->showTable = true;
    }
}