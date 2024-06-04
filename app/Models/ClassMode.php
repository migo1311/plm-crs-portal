<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassMode extends Model
{
    use HasFactory;

    protected $fillable = [
        'mode_code',
        'mode_type',
    ];

    public function classSchedules()
    {
        return $this->hasMany(ClassSchedule::class, 'class_mode_id');
    }
}
