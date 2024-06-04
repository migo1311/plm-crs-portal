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

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    public function aysem()
    {
        return $this->belongsTo(Aysem::class);
    }
}
