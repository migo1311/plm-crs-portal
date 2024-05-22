<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Grade extends Model
{
    use HasFactory;

    protected $primaryKey = 'grade_id';

    protected $fillable = [
        'class_student_id',
        'initial_grade',
        'final_grade',
        'finalization_date',
        'completion_grade',
        'remark_id',
    ];

    public function classStudent(): BelongsTo
    {
        return $this->belongsTo(ClassStudent::class, 'class_student_id', 'class_student_id');
    }

    public function remark(): BelongsTo
    {
        return $this->belongsTo(Remark::class, 'remark_id', 'remark_id');
    }
}
