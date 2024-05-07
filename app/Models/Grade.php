<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }

    public function taClass(): BelongsTo
    {
        return $this->belongsTo(TAClass::class, 'class_id', 'class_id');
    }

    public function remark(): BelongsTo
    {
        return $this->belongsTo(Remark::class, 'remark_id', 'remark_id');
    }
}
