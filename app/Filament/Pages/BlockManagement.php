<?php

namespace App\Filament\Pages;

use App\Models\Aysem;
use App\Models\Student;
use App\Models\Block;
use App\Models\ClassSchedule;
use App\Models\TaClass;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Livewire;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Filament\Pages\Page;
use Filament\Forms\Components;
use Filament\Forms\Form;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;

class BlockManagement extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.block-management';

    protected static ?string $navigationGroup = 'Enrollment';

    public $blockCount;
    public $selectedYear;
    public $showModal = false;
    public $blocks = [];
    public $schedules;
    public $TaClass;
    public $scheduleCount;
    public $showTable = false;

    protected $listeners = ['showModal'];
    protected $rules = [
        'blockCount' => 'required|integer|min:1',
    ];

    public function showModal($year)
    {
        $this->selectedYear = $year;
        $this->showModal = true;
    }

    public function mount()
    {
        // Retrieve blocks grouped by year_level and count sections
        $this->blocks = Block::select('year_level', 'section')
            ->orderBy('year_level')
            ->orderBy('section')
            ->get()
            ->groupBy('year_level')
            ->map(function ($yearBlocks) {
                return $yearBlocks->countBy('section');
            });

        $this->schedules = ClassSchedule::all();
        $this->TaClass = TaClass::all();
        $this->scheduleCount = $this->schedules->count();
    }

    public function sortUnits($column, $direction)
    {
        // Fetch schedules with associated TaClass and sort by units
        $this->schedules = ClassSchedule::join('TaClass', 'class_schedules.class_id', '=', 'TaClass.id')
            ->with('class.course')
            ->orderBy('TaClass.units', $direction)
            ->get();
    }

    public function addAccordion($year)
    {
        $this->selectedYear = $year;
        $this->showModal = true;
    }

    public function createBlocks()
    {
        $year = $this->selectedYear;
        $startSection = 1;
        $maxSectionIncrement = 10; // Adjust this value based on your column limit
      
        $existingBlocks = Block::where('year_level', $year)->get();
        if ($existingBlocks->isNotEmpty()) {
          $lastBlock = $existingBlocks->sortByDesc('section')->first();
          $startSection = $lastBlock->section + 1;
        }
      
        for ($i = 0; $i < min($this->blockCount, $maxSectionIncrement); $i++) { // Limit increment
          $block_id = $year . '-' . ($startSection + $i);
          $existingBlock = Block::where('block_id', $block_id)->first();

            if ($existingBlock) {
                session()->flash('error', 'Block with the same block_id already exists.');
                return;
            }

            $block = new Block();
            $block->block_id = $block_id;
            $block->year_level = $year;
            $block->section = $startSection + $i;
            $block->program_id = 1;
            $block->block_name = " ";
            $block->block_code = " ";
            $block->slots = 50;
            $block->save();
        }

        session()->flash('message', 'Blocks created successfully.');
    }

    private function getYearFromPreviousBlock()
    {
        // Fetch the previous block from the database
        $previousBlock = Block::latest()->first();

        // Extract the year from the block_id of the previous block
        return substr($previousBlock->block_id, 0, 1);
    }

    private function getStartSectionFromPreviousBlock()
    {
        // Fetch the previous block from the database
        $previousBlock = Block::latest()->first();

        // Extract the starting section from the block_id of the previous block
        return intval(substr($previousBlock->block_id, 2));
    }

    private function getBlockCountFromPreviousBlock()
    {
        // Fetch the previous block from the database
        $previousBlock = Block::latest()->first();

        // Extract the section from the block_id of the previous block
        return intval(substr($previousBlock->block_id, 2));
    }

}
