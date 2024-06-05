<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSchedule extends Model
{
    use HasFactory;
// 
    protected $fillable = [
        'class_id',
        'day_id',
        'start_time',
        'end_time',
        'class_mode_id',
        'room_id',
        'schedule_name'
    ];

    public function class()
    {
        return $this->belongsTo(Classes::class);
    }

    public function classMode()
    {
        return $this->belongsTo(ClassMode::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function day()
    {
        return $this->belongsTo(Days::class);
    }
}
