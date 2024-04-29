<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'class_id',
        'initial_grade',
        'final_grade',
        'finalization_date',
        'completion_grade',
        'remark_id',
    ];
}
