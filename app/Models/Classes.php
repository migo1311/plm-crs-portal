<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $table = 'classes';

    protected $fillable = [
        'course_id',
        'aysem_id',
        'block_id',
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
        'effectivity_dateSL'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function aysem()
    {
        return $this->belongsTo(Aysem::class, 'aysem_id');
    }

    public function block()
    {
        return $this->belongsTo(Block::class, 'block_id');
    }

    public function classRestrictions()
    {
        return $this->hasMany(ClassRestriction::class, 'class_id');
    }

    public function instructor()
    {
        return $this->belongsToMany(Instructor::class, 'class_faculty', 'class_id', 'instructor_id')->withTimestamps();
    }

    public function classSchedules()
    {
        return $this->hasMany(ClassSchedule::class, 'class_id');
    }

    public function student()
    {
        return $this->belongsToMany(Student::class, 'student_class', 'class_id', 'student_no')->withTimestamps();
    }

    public function updateStudentsQuantity()
    {
        $this->students_qty = $this->student()->count();
        $this->save();
    }

    public function grades()
    {
        return $this->hasMany(Grade::class, 'class_id');
    }
}
