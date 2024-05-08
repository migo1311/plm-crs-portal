<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentEducation extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'lrn',
        'school_name',
        'school_address',
        'school_type',
        'strand',
        'year_entered',
        'year_graduated',
        'honors_awards',
        'general_average',
        'remarks',
        'org_name',
        'org_position',
        'previous_tertiary',
        'previous_sem',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }
}
