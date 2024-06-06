<?php

namespace App\Filament\Pages;

use App\Models\Block;
use App\Models\Classes;
use App\Models\Student;
use Filament\Pages\Page;
use Filament\Forms\Components;
use Filament\Forms\Form;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Table;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Concerns\InteractsWithTable;

class Registration extends Page
{

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.registration';

    protected static ?int $navigationSort = 2;

    public $showTable = false;
    public $selectedStudent, $blockStats;
    public $studentId;
    public $SelectedStudentId = false;

    
}