<?php

namespace App\Filament\Pages;

use App\Models\Block;
use App\Models\TaClass;
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
            ->model(TaClass::class)
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

        return $table
            ->query(TaClass::query()->whereHas('blocks', function ($query) {
                $query->where('blocks.block_id', '=', $this->data);
            }))
            ->heading(Block::query()->where('block_id', '=', $this->data)->get('block_name')->value('block_name'))
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
