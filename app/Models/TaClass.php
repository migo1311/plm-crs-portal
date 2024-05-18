<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TaClass extends Model
{
    use HasFactory;

    protected $primaryKey = 'class_id';
    
    protected $fillable = [
        'course_id',
        'section',
        'students_qty',
        'credited_units',
        'actual_units',
        'slots',
        'instructor_id',
        'aysem_id',
        'nstp_activity',
        'parent_class_code',
        'link_type',
        'instruction_language',
        'minimum_year_level',
        'teams_assigned_link',
        'effectivity_dateSL'
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id', 'course_id');
    }

    public function instructor(): BelongsTo
    {
        return $this->belongsTo(InstructorProfile::class, 'instructor_id', 'instructor_id');
    }

    public function aysem(): BelongsTo
    {
        return $this->belongsTo(Aysem::class, 'aysem_id', 'aysem_id');
    }

    public function classSchedules(): HasMany
    {
        return $this->hasMany(ClassSchedule::class, 'classes_id', 'class_id');
    }

    public function grade(): HasMany
    {
        return $this->hasMany(Grade::class, 'class_id', 'class_id');
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'class_student', 'class_id', 'student_id')->withTimestamps();
    }

    public function updateStudentsQuantity()
    {
        $this->students_qty = $this->students()->count();
        $this->save();
    }

    public function blocks(): BelongsToMany
    {
        return $this->belongsToMany(Block::class, 'block_class', 'class_id', 'block_id')->withTimestamps();
    }

    public function classRestrictions(): HasMany
    {
        return $this->hasMany(ClassRestriction::class, 'class_id', 'class_id');
    }
}
