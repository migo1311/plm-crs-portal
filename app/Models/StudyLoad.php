<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyLoad extends Model
{
    use HasFactory;

    protected $fillable = [
        'instructor_id',
        'study_units',
        'teaching_units',
        'aysem_id',
        'entered_by',
        'entered_on'
    ];

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    public function aysem()
    {
        return $this->belongsTo(Aysem::class);
    }
}
