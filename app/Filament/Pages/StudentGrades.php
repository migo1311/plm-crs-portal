<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class StudentGrades extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.student-grades';

    protected static ?string $navigationGroup = 'Print Forms';
}
