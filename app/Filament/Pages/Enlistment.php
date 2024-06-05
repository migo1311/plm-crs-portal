<?php

namespace App\Filament\Pages;

use App\Models\Aysem;
use App\Models\StudentTerm;
use App\Models\Block;
use App\Models\Program;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Forms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Collection;

class Enlistment extends Page implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Enrollment';
    protected static string $view = 'filament.pages.enrollment-enlistment';

    public $bulk_student_block;
    public $filterEnrolled = false;
    public $selectedStudents = [];
    public $view_student_id;
    public $view_lastname;
    public $view_student_type;
    public $view_student_block;
    public $view_year_level;
    public $view_program_code;
    public $showDetails = false;

    public function getTableQuery(): \Illuminate\Database\Eloquent\Builder
    {
        $currentAYSem = Aysem::orderBy('date_start', 'desc')->first();

        $query = StudentTerm::query()
            ->select(
                'student_terms.*',
                'students.student_id',
                'students.lastname',
                'student_type',
                'blocks.section',
                'programs.program_code'
            )
            ->join('students', 'students.student_id', '=', 'student_terms.student_id')
            ->leftJoin('blocks', 'blocks.block_id', '=', 'student_terms.block_id')
            ->leftJoin('programs', 'programs.program_id', '=', 'blocks.program_id')
            ->where('student_terms.aysem_id', $currentAYSem->aysem_id);

        if ($this->filterEnrolled) {
            $query->where('student_terms.enrolled', 1);
        }

        return $query;
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('student_id')->label('Student ID'),
            TextColumn::make('lastname')->label('Student Name'),
            TextColumn::make('student_type')->label('Student Type'),
            TextColumn::make('enrolled')
                ->label('Enrollment Status')
                ->formatStateUsing(fn($state) => $state ? 'Enrolled' : 'Enlisted'),
            TextColumn::make('section')->label('Block'),
            TextColumn::make('year_level')->label('Year Level'),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Action::make('view')
                ->label('View')
                ->form(function ($record) {
                    $program = Program::where('program_code', 'BSCS')->first();
                    if (!$program) {
                        abort(404, 'Program BSCS not found.');
                    }
                    $currentAYSem = Aysem::orderBy('date_start', 'desc')->first();

                    $blocks = Block::where('program_id', $program->program_id)
                        ->where('year_level', $record->year_level)
                        ->where('aysem_id', $currentAYSem->aysem_id)
                        ->pluck('section', 'block_id');

                    return [
                        TextInput::make('student_id')
                            ->label('Student ID')
                            ->default($record->student_id)
                            ->disabled(),
                        TextInput::make('lastname')
                            ->label('Student Name')
                            ->default($record->lastname)
                            ->disabled(),
                        TextInput::make('student_type')
                            ->label('Student Type')
                            ->default($record->student_type)
                            ->disabled(),
                        Select::make('block_id')
                            ->label('Block')
                            ->options($blocks)
                            ->default($record->block_id)
                            ->required(),
                        TextInput::make('year_level')
                            ->label('Year Level')
                            ->default($record->year_level)
                            ->disabled(),
                    ];
                })
                ->action(function (array $data, StudentTerm $record) {
                    $record->update([
                        'block_id' => $data['block_id'],
                    ]);
                    $this->viewStudentDetails($record->student_term_id);
                }),
        ];
    }

    protected function getTableFilters(): array
    {
        return [
            Filter::make('year_level')
                ->label('Year Level')
                ->query(fn($query, $data) => $query->where('student_terms.year_level', $data['year_level']))
                ->form([
                    Forms\Components\Select::make('year_level')
                        ->options([
                            1 => 'First Year',
                            2 => 'Second Year',
                            3 => 'Third Year',
                            4 => 'Fourth Year',
                        ])
                        ->placeholder('Select Year Level'),
                ]),
            Filter::make('enrollment_status')
                ->label('Enrollment Status')
                ->query(fn($query, $data) => $query->where('student_terms.enrolled', $data['enrolled']))
                ->form([
                    Forms\Components\Select::make('enrolled')
                        ->options([
                            1 => 'Enrolled',
                            0 => 'Enlisted',
                        ])
                        ->placeholder('Select Enrollment Status'),
                ]),
        ];
    }

    public function viewStudentDetails($id)
    {
        $student = StudentTerm::where('student_terms.student_term_id', $id)
            ->join('students', 'students.student_id', '=', 'student_terms.student_id')
            ->join('blocks', 'blocks.block_id', '=', 'student_terms.block_id')
            ->join('programs', 'programs.program_id', '=', 'blocks.program_id')
            ->first(['students.*', 'student_terms.*', 'blocks.section', 'programs.program_code']);

        if (!$student) {
            abort(404);
        }

        $this->view_student_id = $student->student_id;
        $this->view_lastname = $student->lastname;
        $this->view_student_type = $student->student_type;
        $this->view_student_block = $student->block_id;
        $this->view_year_level = $student->year_level;
        $this->view_section = $student->section;
        $this->view_program_code = $student->program_code;
        $this->showDetails = false;
    }
}
