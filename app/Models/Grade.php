<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_no',
        'class_id',
        'grade',
        'remarks',
        'completion_grade',
        'submitted_date',
        'finalization_date',
        'updated_by',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_no');
    }

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }
}
