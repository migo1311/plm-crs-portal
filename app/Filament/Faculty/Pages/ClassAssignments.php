<?php

namespace App\Filament\Faculty\Pages;

use Filament\Pages\Page;

class ClassAssignments extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static string $view = 'filament.faculty.pages.class-assignments';
    
    protected static ?int $navigationsort = 1;
}
