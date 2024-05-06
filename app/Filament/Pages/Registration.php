<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Registration extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.registration';

    protected static ?int $navigationsort = 2;
}
