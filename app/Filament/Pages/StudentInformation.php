<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class StudentInformation extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.student-information';

    protected static ?string $navigationGroup = 'Utilities';
}
