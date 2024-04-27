<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class PrintClassList extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.print-class-list';

    protected static ?string $navigationGroup = 'Print Forms';
}
