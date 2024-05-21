<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudyLoad extends Model
{
    use HasFactory;

    protected $primaryKey = 'study_load_id';
    protected $fillable = [
        'instructor_id',
        'study_units',
        'teaching_units',
        'aysem_id',
        'entered_by',
        'entered_on'
    ];

    public function aysem(): BelongsTo
    {
        return $this->belongsTo(Aysem::class, 'aysem_id', 'aysem_id');
    }

    public function instructor(): BelongsTo
    {
        return $this->belongsTo(InstructorProfile::class, 'instructor_id', 'instructor_id');
    }
}
