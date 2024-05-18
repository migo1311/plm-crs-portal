<?php

namespace App\Filament\Pages;

use App\Enums\ClassRestrictionScopeEnum;
use App\Models\AcademicYear;
use App\Models\Aysem;
use App\Models\Block;
use App\Models\ClassRestriction;
use App\Models\ClassSchedule;
use App\Models\College;
use App\Models\Course;
use App\Models\InstructorProfile;
use App\Models\Mode;
use App\Models\Program;
use App\Models\Room;
use App\Models\TaClass;
use Filament\Tables\Actions\CreateAction;
use Filament\Forms\Components;
use Filament\Forms\Components\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Notifications\Collection;
use Filament\Tables\Actions\EditAction as ActionsEditAction;
use Illuminate\Contracts\Session\Session;
use Illuminate\Database\Eloquent\Model;

class Schedules extends Page implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    protected static string $view = 'filament.pages.schedules';

    protected static ?int $navigationsort = 1;

    public function table(Table $table): table
    {
        return $table
            ->query(TaClass::query())
            ->columns([
                TextColumn::make('course.subject_code'),
                TextColumn::make('section'),
                TextColumn::make('course.subject_title')
                    ->wrap(),
                TextColumn::make('classSchedules.schedule_name')
                    ->wrap(),
                TextColumn::make('instructor.instructor_code'),
                TextColumn::make('slots'),
                TextColumn::make('students_qty'),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                ActionsEditAction::make()
                    ->modalHeading('Edit Class')
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
                                ]),
                        Step::make('Schedule Information')
                            ->schema([
                                Components\Repeater::make('schedules')
                                    ->relationship('classSchedules')
                                    ->columns(5)
                                    ->schema([
                                        Components\Select::make('day')
                                            ->options([
                                                'Monday' => 'Monday',
                                                'Tuesday' => 'Tuesday',
                                                'Wednesday' => 'Wednesday',
                                                'Thursday' => 'Thursday',
                                                'Friday' => 'Friday',
                                                'Saturday' => 'Saturday',
                                                'Sunday' => 'Sunday',
                                            ])
                                            ->required(),
                                        Components\TimePicker::make('start_time')
                                            ->label('Start Time')
                                            ->seconds(false)
                                            ->minutesStep(15)
                                            ->required(),
                                        Components\TimePicker::make('end_time')
                                            ->label('End Time')
                                            ->seconds(false)
                                            ->minutesStep(15)
                                            ->required(),
                                        Components\Select::make('mode_id')
                                            ->relationship('mode', 'mode_type')
                                            ->label('Meeting Type')
                                            ->required(),
                                        Components\Select::make('room_id')
                                            ->relationship('room', 'room_name')
                                            ->searchable()
                                            ->label('Room')
                                            ->placeholder('Select')
                                            ->options(Room::all()->pluck('room_name', 'room_id')->toArray())
                                            ->required(),
                                    ])
                                ]),
                    ])
                    ->using(function (array $data, Model $record) {

                        $record->update($data);
                    })
                ])
            ->headerActions([
                CreateAction::make('Create Class')
                    ->modelLabel('Class')
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
                                ->afterValidation(function ($get, $set) {
                                    
                                    $exists = TaClass::query()
                                    ->where('course_id', '=', $get('course_id'))
                                    ->where('instructor_id', '=', $get('instructor_id'))
                                    ->where('section', '=', $get('section'))
                                    ->first();

                                    if ($get('actual_units') == null){
                                        $set('actual_units', $get('credited_units'));
                                    }

                                    if ($get('aysem_id') == null){
                                        $currentDate = now();
                                        $ayear = AcademicYear::where('date_start', '<=', $currentDate)
                                            ->where('date_end', '>=', $currentDate)
                                            ->value('academic_year_id');
                                        $aysem = Aysem::where('academic_year_id', '=', $ayear)
                                            ->value('aysem_id');

                                        $set('aysem_id', $aysem);
                                    }

                                    if (!$exists){
                                        $fields = TaClass::create([
                                            'course_id' => $get('course_id'),
                                            'instructor_id' => $get('instructor_id'),
                                            'section' => $get('section'),
                                            'nstp_activity' => $get('nstp_activity'),
                                            'credited_units' => $get('credited_units'),
                                            'actual_units' => $get('actual_units'),
                                            'slots' => $get('slots'),
                                            'minimum_year_level' => $get('minimum_year_level'),
                                            'instruction_language' => $get('instruction_language'),
                                            'parent_class_code' => $get('parent_class_code'),
                                            'aysem_id' => $get('aysem_id'),
                                            'link_type' => $get('link_type'),
                                        ]);
                                    }                            
                                    // dd($fields);
                                    if ($exists){
                                        session()->put('class_id', $exists->class_id); 
                                    }else{
                                        session()->put('class_id', $fields->class_id);
                                    }
                                })
                                ,
                        Step::make('Schedule Information')
                            ->model(ClassSchedule::class)
                            ->schema([
                                Components\Repeater::make('schedules')
                                    ->columns(5)
                                    ->schema([
                                        Components\Select::make('day')
                                            ->options([
                                                'Monday' => 'Monday',
                                                'Tuesday' => 'Tuesday',
                                                'Wednesday' => 'Wednesday',
                                                'Thursday' => 'Thursday',
                                                'Friday' => 'Friday',
                                                'Saturday' => 'Saturday',
                                                'Sunday' => 'Sunday',
                                            ])
                                            ->required(),
                                        Components\TimePicker::make('start_time')
                                            ->label('Start Time')
                                            ->seconds(false)
                                            ->minutesStep(15)
                                            ->required(),
                                        Components\TimePicker::make('end_time')
                                            ->label('End Time')
                                            ->seconds(false)
                                            ->minutesStep(15)
                                            ->required(),
                                        Components\Select::make('mode_id')
                                            ->relationship('mode', 'mode_type')
                                            ->label('Meeting Type')
                                            ->required(),
                                        Components\Select::make('room_id')
                                            ->relationship('room', 'room_name')
                                            ->searchable()
                                            ->label('Room')
                                            ->options(Room::all()->pluck('room_name', 'room_id')->toArray())
                                            ->required(),
                                    ])
                            ])
                            ->afterValidation(function ($get) {

                                $classId = session()->get('class_id');
                                if (!$classId) {
                                    throw new \Exception("Class ID not found in session. Ensure the class was created successfully.");
                                }

                                $schedules = $get('schedules');
                    
                                // Create each schedule
                                foreach ($schedules as $schedule) {

                                    $day = $schedule['day'];
                                    $start = $schedule['start_time'];
                                    $end = $schedule['end_time'];
                                    $mode = Mode::query()->where('mode_id', '=', $schedule['mode_id'])->value('mode_code');
                                    $room = Room::query()->where('room_id', '=', $schedule['room_id'])->value('room_name');
                                    $name = $day[0] . ' ' . $start . ' - ' . $end . ' ' . $mode . ' ' . $room;

                                    $data = [
                                        'classes_id' => $classId,
                                        'day' => $day,
                                        'start_time' => $start,
                                        'end_time' => $end,
                                        'mode_id' => $schedule['mode_id'],
                                        'room_id' => $schedule['room_id'],
                                        'schedule_name' => $name
                                    ];

                                    $exists = ClassSchedule::query()
                                    ->where('classes_id', '=', $data['classes_id'])
                                    ->where('day', '=', $data['day'])
                                    ->where('start_time', '=', $data['start_time'])
                                    ->where('end_time', '=', $data['end_time'])
                                    ->first();

                                    if (!$exists){
                                        ClassSchedule::create($data);
                                    }
                                }
                            }),
                        Step::make('Class Restrictions')
                            ->model(ClassRestriction::class)
                            ->schema([
                                Components\Repeater::make('restrictions')
                                    ->columns(3)
                                    ->schema([
                                        Components\Select::make('scope')
                                        ->options([
                                            'block' => ClassRestrictionScopeEnum::block->value,
                                            'college' => ClassRestrictionScopeEnum::college->value,
                                            'program' => ClassRestrictionScopeEnum::program->value,
                                            'program & year-level' => ClassRestrictionScopeEnum::program_and_year->value,
                                            'user' => ClassRestrictionScopeEnum::user->value,
                                            'gender' => ClassRestrictionScopeEnum::gender->value,
                                        ])
                                        ->live()
                                        ->preload()
                                        ->required(),
                                        Components\Select::make('restriction')
                                            ->options(function ($get):
                                                array {
                                                    $scope = $get('scope');
                                                    $restrictions = [];

                                                    switch ($scope) {
                                                        case 'block':
                                                            $restrictions = Block::all()->pluck('block_name', 'block_name')->toArray();
                                                            break;
                                                        case 'college':
                                                            $restrictions = College::all()->pluck('college_name', 'college_name')->toArray();
                                                            break;
                                                        case 'program':
                                                            $restrictions = Program::all()->pluck('program_title', 'program_title')->toArray();
                                                            break;
                                                        case 'program & year-level':
                                                            $programs = Program::all()->pluck('program_title', 'program_title')->toArray();
                                                            $years = [
                                                                '1st Year' => 1,
                                                                '2nd Year' => 2,
                                                                '3rd Year' => 3,
                                                                '4th Year' => 4,
                                                                '5th Year' => 5,
                                                                '6th Year' => 6,
                                                                '7th Year' => 7,
                                                            ];
                                                        
                                                            foreach ($programs as $programId => $programName) {
                                                                foreach ($years as $yearId => $yearName) {
                                                                    $restrictions[$programId . '_' . $yearId] = $programName . ' - ' . $yearName;
                                                                }
                                                            }
                                                            break;
                                                        case 'user':
                                                            $restrictions = InstructorProfile::all()->pluck('faculty_name', 'faculty_name')->toArray();
                                                            break;
                                                        default:
                                                            // Handle unknown scope or other cases
                                                            break;
                                                    }
                                                
                                                    return $restrictions;
                                                })
                                            ->live()
                                            ->preload()
                                            ->searchable()
                                            ->required()
                                            ->columnSpan(2),
                                    ])
                            ]),
                    ])
                    ->using(function (array $data): ClassRestriction {
                        $pair = [];

                        foreach ($data['restrictions'] as $key => $value) {

                            $datas = [
                                'class_id' => session()->get('class_id'), 
                                'scope' => $value['scope'],
                                'restriction' => $value['restriction'],
                            ];

                            $exists = ClassRestriction::query()
                            ->where('class_id', '=', $datas['class_id'])
                            ->where('scope', '=', $datas['scope'])
                            ->where('restriction', '=', $datas['restriction'])
                            ->first();

                            if (!$exists){
                                $pair[$key] = $datas;
                            }
                            
                        }

                        foreach ($pair as $data) {
                            $createdModel = ClassRestriction::create($data);
                        }

                        session()->forget('class_id');
                        return $createdModel;
                    })
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Schedules::route('/'),
        ];
    }
    
}
