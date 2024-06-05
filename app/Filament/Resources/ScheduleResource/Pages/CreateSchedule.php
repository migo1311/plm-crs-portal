<?php

namespace App\Filament\Resources\ScheduleResource\Pages;

use App\Filament\Resources\ScheduleResource;
use App\Models\Aysem;
use App\Models\Classes;
use App\Models\ClassMode;
use App\Models\ClassRestriction;
use App\Models\ClassSchedule;
use App\Models\Days;
use App\Models\Instructor;
use App\Models\Room;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateSchedule extends CreateRecord
{
    protected static string $resource = ScheduleResource::class;
 
    protected function handleRecordCreation(array $data): Model
    {
        
        if ($data['actual_units'] == null){
            $data['actual_units'] = $data['credited_units'];
        }

        $classData = [
            'course_id' => intval($data['course_id']),
            'aysem_id' => Aysem::all()->last()->id,
            'block_id' => intval($data['block_id']),
            'nstp_activity' => $data['nstp_activity'],
            'credited_units' => $data['credited_units'],
            'actual_units' => $data['actual_units'],
            'slots' => $data['slots'],
            'minimum_year_level' => $data['minimum_year_level'],
            'instruction_language' => $data['instruction_language'],
            'parent_class_code' => $data['parent_class_code'],
            'link_type' => $data['link_type'],
        ];

        $class = Classes::create($classData);

        foreach ($data['faculty'] as $instructor) {
            $class->instructor()->attach($instructor['instructor_id']);
        }

        $scheduleData = [];

        foreach ($data['schedules'] as $schedule) {

            $day = Days::query()->where('id', '=', $schedule['day_id'])->value('day_code');
            $start = date("g:i A", strtotime($schedule['start_time']));
            $end = date("g:i A", strtotime($schedule['end_time']));
            $mode = ClassMode::query()->where('id', '=', $schedule['class_mode_id'])->value('mode_code');
            $room = Room::query()->where('id', '=', $schedule['room_id'])->value('room_name');
            $name = $day . ' ' . $start . ' - ' . $end . ' ' . $mode . ' ' . $room;

            $scheduleData[] = [
                'class_id' => $class->id,
                'day_id' => intval($schedule['day_id']),
                'start_time' => $schedule['start_time'],
                'end_time' => $schedule['end_time'],
                'class_mode_id' => intval($schedule['class_mode_id']),
                'room_id' => intval($schedule['room_id']),
                'schedule_name' => $name
            ];
        }

        foreach ($scheduleData as $schedule) {
            ClassSchedule::create($schedule);
        }

        $restrictionData = [];

        foreach ($data['restrictions'] as $restriction) {
                $restrictionData[] = [
                    'class_id' => $class->id,
                    'scope' => $restriction['scope'],
                    'restriction' => $restriction['restriction']
                ];
        }

        foreach ($restrictionData as $restriction) {
            ClassRestriction::create($restriction);
        }

        return $class;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}