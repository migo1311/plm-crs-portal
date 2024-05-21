<?php

namespace App\Filament\Faculty\Pages;

use Filament\Navigation\NavigationItem;
use Filament\Pages\Page;

class TeachingAssignment extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-magnifying-glass';

    protected static string $view = 'filament.faculty.pages.teaching-assignment';

    protected static ?int $navigationsort = 2;
}
