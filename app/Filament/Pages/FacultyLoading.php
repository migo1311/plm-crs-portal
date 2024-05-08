<?php

namespace App\Filament\Pages;

use App\Models\Aysem;
use App\Models\TaClass;
use Filament\Forms\Components;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables; // Add this line

class FacultyLoading extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.faculty-loading';

    protected static ?string $navigationGroup = 'Print Forms';

    public function form(Form $form): Form
    {
        return $form->columns(1)->schema([
            Components\Select::make('Select')
                ->placeholder('AYSEM')
                ->options(Aysem::pluck('year')) // Assuming Faculty model has 'name' and 'id' fields
                ->required(),
        ]);
    }


}
