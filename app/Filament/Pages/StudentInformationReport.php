<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class StudentInformationReport extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.student-information-report';

    protected static ?string $navigationGroup = 'Print Forms';
}
