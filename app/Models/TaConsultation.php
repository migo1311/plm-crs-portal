<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaConsultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'instructor_id',
        'day',
        'time_start',
        'time_end',
        'num_hours',
        'aysem_id',
    ];
}
