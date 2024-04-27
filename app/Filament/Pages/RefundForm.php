<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class RefundForm extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.refund-form';

    protected static ?string $navigationGroup = 'Print Forms';
}
