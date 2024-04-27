<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class PrintGradeSheet extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.print-grade-sheet';

    protected static ?string $navigationGroup = 'Print Forms';
}
