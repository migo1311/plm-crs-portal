<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id',
        'subject_code',
        'subject_title',
        'course_number',
        'units',
        'class_code',
        'pre_requisite',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }

    public function classes()
    {
        return $this->hasMany(Classes::class, 'course_id');
    }
}
