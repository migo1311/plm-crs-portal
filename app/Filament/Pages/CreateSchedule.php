<?php

namespace App\Filament\Pages;

use App\Models\Course;
use Filament\Forms\Components\Section;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Illuminate\Contracts\View\View;

class CreateSchedule extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $title = 'Create Schedule';

    protected static bool $isDiscovered = false;

    protected static string $view = 'filament.pages.create-schedule';

    public ?array $data = [];
    
    public function mount(): void
    {
        $this->form->fill();
    }

    // public static function route(): string
    // {
    //     return '/crs/schedule/create';
    // }
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Class Information')
                    ->schema([
                        Components\TextInput::make('class_id')
                            ->label('Class ID')
                            ->hidden(),
                        Components\Select::make('id') 
                            ->relationship(
                                name: 'course', 
                                titleAttribute: 'course_number',
                                // modifyQueryUsing: function ($query) {
                                //     return $query->where('aysem_id', 20231);}
                                )
                            ->label('Course')
                            ->live()
                            ->afterStateUpdated(function ($state, $set){
                                $units = Course::query()->where('id', '=', $state)->value('units');
                                $set('credited_units', $units);
                            })
                            ->columnSpanFull()
                            ->required(),                                        
                        Components\Select::make('instructor_id')
                            ->relationship('instructor', 'faculty_name')
                            ->label('Faculty')
                            ->required()
                            ->columnSpanFull(),                               
                        Components\TextInput::make('section')
                            ->label('Section')
                            ->numeric()
                            ->required()                                         
                            ->columnSpan(1),
                        Components\TextInput::make('nstp_activity')
                            ->label('NSTP Activity')                                        
                            ->helperText('To be filled ONLY when class to be Added is an NSTP subject')
                            ->columnSpan(3),
                        Components\TextInput::make('credited_units')
                            ->readOnly()
                            ->label('Credits')
                            ->numeric()
                            ->columnSpan(1),
                        Components\TextInput::make('actual_units')
                            ->label('Actual Credits')
                            ->helperText('To be filled IF Credits field is NOT the same as the Actual Class Credit')
                            ->numeric()
                            ->columnSpan(3),
                        Components\TextInput::make('slots')
                            ->label('Alloted Slots')
                            ->numeric()
                            ->required()
                            ->columnSpan(1),
                        Components\Select::make('minimum_year_level')
                            ->options([
                                1 => '1st Year',
                                2 => '2nd Year',
                                3 => '3rd Year',
                                4 => '4th Year',
                                5 => '5th Year',
                                6 => '6th Year',
                                7 => '7th Year',
                            ])
                            ->columnSpan(2),
                        Components\Select::make('instruction_language')
                            ->options([
                                'English' => 'English',
                                'Filipino' => 'Filipino',
                                'Spanish' => 'Spanish',
                                'Other' => 'Other',
                            ])
                            ->required()
                            ->columnSpan(1),
                        Components\TextInput::make('parent_class_code')
                            ->label('Parent Class Code')
                            ->helperText('NOTE: If course is dependent on another course, write the class code of the parent course. Lab and discussion classes usually have lecture components
                            and thus, this field must NOT be left blank.')
                            ->columnSpan(3),
                        Components\Select::make('link_type')
                            ->options([
                                'Link Type-Parent' => 'parent',
                                'Link Type-Co-Parent' => 'co-parent',
                            ])
                            ->columnSpan(1),
                        Components\TextInput::make('aysem_id')
                            ->hidden(),
                    ])
            ])->statePath('data');
    }

    public function render(): View
    {
        return view('filament.pages.create-schedule');
    }

}
