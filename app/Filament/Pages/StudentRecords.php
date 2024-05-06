<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class StudentRecords extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.student-records';

    protected static ?int $navigationsort = 3;
}
