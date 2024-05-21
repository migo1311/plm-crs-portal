<?php

namespace App\Filament\Faculty\Pages;

use Filament\Pages\Page;

class FacultyInformation extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.faculty.pages.faculty-information';

    protected static ?int $navigationsort = 4;
}
