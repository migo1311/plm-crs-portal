<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class PrintAssessmentForm extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.print-assessment-form';

    protected static ?string $navigationGroup = 'Print Forms';
}
