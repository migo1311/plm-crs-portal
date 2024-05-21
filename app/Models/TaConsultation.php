<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaConsultation extends Model
{
    use HasFactory;

    protected $primaryKey = 'ta_consultation_id';

    protected $fillable = [
        'instructor_id',
        'day',
        'time_start',
        'time_end',
        'num_hours',
        'aysem_id',
    ];

    public function aysem()
    {
        return $this->belongsTo(Aysem::class, 'aysem_id', 'aysem_id');
    }

    public function instructor()
    {
        return $this->belongsTo(InstructorProfile::class, 'instructor_id', 'instructor_id');
    }
}
