<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaClass extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_ID',
        'section',
        'students_qty',
        'credited_units',
        'slots',
        'instructor_id',
        'aysem_id',
        'nstp_activity',
        'parent_class_code',
        'link_type',
        'instruction_language',
        'class_restriction_id',
        'teams_assigned_link',
        'effectivity_dateSL'
    ];
}
