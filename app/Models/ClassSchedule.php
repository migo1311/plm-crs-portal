<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClassSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'classes_id',
        'day',
        'start_time',
        'end_time',
        'mode_id',
        'room_id',
        'schedule_name'
    ];

    public function classes(): BelongsTo
    {
        return $this->belongsTo(TaClass::class, 'classes_id', 'class_id');
    }
}
