<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class TeachingAssignment extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.teaching-assignment';

    protected static ?string $navigationGroup = 'Print Forms';
}
