<?php
 
namespace App\Livewire;

use App\Models\TaClass;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
 
class ListProducts extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;
    
    public function table(Table $table): Table
    {
        return $table
            ->query(TaClass::query())
            ->columns([
                TextColumn::make('students.student_id')
                    ->label('Student ID'),
                TextColumn::make('students.firstname')
                ->formatStateUsing(function ($state, $record) {
                    return $state . ' ' . $record->middleinitial . ' ' . $record->lastname;
                }),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                // ...
            ])
            ->bulkActions([
                // ...
            ]);
    }
}