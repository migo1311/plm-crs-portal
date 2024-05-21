<?php

namespace App\Filament\Faculty\Pages;

use Filament\Pages\Page;

class GradeSheet extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-check';

    protected static string $view = 'filament.faculty.pages.grade-sheet';
    
    protected static ?int $navigationsort = 3;
}
