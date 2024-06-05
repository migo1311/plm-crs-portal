<?php

namespace App\Filament\Faculty\Pages;

use App\Models\Instructor;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class FacultyInformation extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-identification';

    protected static string $view = 'filament.faculty.pages.faculty-information';

    protected static ?int $navigationsort = 4;

    public $faculty;
    public $instructor;
    public $college;

    public function mount()
    {
        $this->faculty = Auth::user();
        $this->instructor = Instructor::where('instructor_code', $this->faculty->name)->first();
        $this->college = $this->instructor->college->college_name;
    }
}
