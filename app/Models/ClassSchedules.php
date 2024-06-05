<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClassSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'day',
        'start_time',
        'end_time',
        'schedule_name',
        'class_id',
        'class_mode_id',
        'room_id'
    ];
}
