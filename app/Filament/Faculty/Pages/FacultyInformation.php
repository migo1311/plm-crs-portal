<?php

namespace App\Filament\Faculty\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class FacultyInformation extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-identification';

    protected static string $view = 'filament.faculty.pages.faculty-information';

    protected static ?int $navigationsort = 4;

    public $faculty;

    public function mount()
    {
        $this->faculty = Auth::user();
    }
}
