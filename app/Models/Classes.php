<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'students_qty',
        'credited_units',
        'actual_units',
        'slots',
        'nstp_activity',
        'parent_class_code',
        'link_type',
        'instruction_language',
        'minimum_year_level',
        'teams_assigned_link',
        'effectivity_dateSL',
        'course_id',
        'aysem_id',
        'block_id',

    ];

}
