<?php

namespace App\Filament\Pages;

use App\Models\ClassSchedule;
use App\Models\Course;
use App\Models\TaClass;
use Filament\Tables\Actions\CreateAction;
use Filament\Forms\Components;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\Section;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Get;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Wizard\Step;

class Schedules extends Page implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.schedules';

    protected static ?int $navigationsort = 1;

    public function table(Table $table): table
    {
        return $table
            ->query(TaClass::query())
            ->columns([
                TextColumn::make('course.subject_code'),
                TextColumn::make('section'),
                TextColumn::make('course.subject_title'),
                TextColumn::make('classSchedules.schedule_name'),
                TextColumn::make('instructor.instructor_code'),
                TextColumn::make('slots'),
                TextColumn::make('students_qty'),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                // ...
            ])
            ->headerActions([
                CreateAction::make('Create Class')
                    
                    ->label('Add Class')
                    ->steps([
                        Step::make('Class Information')
                        ->model(TaClass::class)
                            ->columns(4)
                            ->schema([
                                Components\TextInput::make('class_id')
                                    ->label('Class ID')
                                    ->hidden(),
                                Components\Select::make('course_id')
                                    ->relationship(
                                        name: 'course', 
                                        titleAttribute: 'course_number',
                                        // modifyQueryUsing: function ($query) {
                                        //     return $query->where('aysem_id', 20231);}
                                        )
                                    ->label('Course')
                                    ->live()
                                    ->afterStateUpdated(function ($state, $set){
                                        $units = Course::query()->where('course_id', '=', $state)->value('units');
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
                                    ->disabled()
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
                                        '1st Year' => '1st Year',
                                        '2nd Year' => '2nd Year',
                                        '3rd Year' => '3rd Year',
                                        '4th Year' => '4th Year',
                                        '5th Year' => '5th Year',
                                        '6th Year' => '6th Year',
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
                                ])
                                ->afterValidation(function ($state) {
                                    TaClass::create($state);
        
                                })
                                ,
                        Step::make('Schedule Information')
                            // ->model(ClassSchedule::class)
                            // ->columns(4)
                            // ->schema([
                            //     Components\TextInput::make('class_id')
                            //         ->hidden(),
                            //     Components\Select::make('day')
                            //         ->options([
                            //             'Monday' => 'Monday',
                            //             'Tuesday' => 'Tuesday',
                            //             'Wednesday' => 'Wednesday',
                            //             'Thursday' => 'Thursday',
                            //             'Friday' => 'Friday',
                            //             'Saturday' => 'Saturday',
                            //             'Sunday' => 'Sunday',
                            //         ]),
                            //     Components\TextInput::make('start_time')
                            //         ->label('Start Time')
                            //         ->type('time')
                            //         ->required(),
                            //     Components\TextInput::make('end_time')
                            //         ->label('End Time')
                            //         ->type('time')
                            //         ->required(),
                            //     Components\Select::make('mode_id')
                            //         ->relationship('mode', 'mode_type')
                            //         ->label('Meeting Type')
                            // ])  
                    ])
            ])
            ->bulkActions([
                // ...
            ]);
    }
    
}
