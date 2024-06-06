<?php

namespace App\Filament\Pages;

use App\Models\Block;
use App\Models\Classes;
use App\Models\Program;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Forms\Components;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BlockClassesUtility extends Page implements HasForms, HasTable
{
    use InteractsWithForms, InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    protected static string $view = 'filament.pages.block-classes-utility';

    protected static ?string $navigationGroup = 'Utilities';

    public ?array $data = [];
    public $showTable = false;
    
    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->model(Classes::class)
            ->schema([
                Components\Select::make('block_id')
                ->relationship('block', 'block_name')
                ->label('Block ID')
                ->placeholder('Select Block ID')
                ->options(Block::all()->pluck('block_name', 'block_id')->toArray())
                ->required()
                ->searchable(),
            ])
            ->statePath('data');
    }

    public function table(Table $table): Table
    {
        // $block = Block::with('program')->where('block_id', '=', $this->data);
        // $programCode = $block->program->program_code;
        // $yearLevel = $block->year_level;
        // $section = $block->section;
        // $blockId = $block->id;
        // $formattedString = "{$programCode} {$yearLevel}-{$section} ({$blockId})";

        return $table
            ->query(Classes::query()->where('block_id', '=', $this->data))
            // ->heading($formattedString)
            ->columns([
                TextColumn::make('class_id')
                    ->label('Class ID')
                    ->sortable(),
                TextColumn::make('course.subject_code')
                    ->label('Class')
                    ->sortable(),
                TextColumn::make('section')
                    ->label('Section')
                    ->sortable(),
                TextColumn::make('classSchedules.schedule_name')
                    ->wrap()
                    ->label('Schedule')
                    ->sortable(),
                TextColumn::make('slots')
                    ->label('Slots')
                    ->sortable(),
            ]);
    }

    public function submit(): void
    {
        $this->showTable = true;
    }
}
