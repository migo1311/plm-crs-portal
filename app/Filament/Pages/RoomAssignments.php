<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class RoomAssignments extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-building-library';

    protected static string $view = 'filament.pages.room-assignments';

    protected static ?string $navigationGroup = 'Utilities';
}
