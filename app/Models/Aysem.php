<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aysem extends Model
{
    use HasFactory;

    protected $fillable = [
        'academic_year_id',
        'year',
        'semester_index',
        'semester_code',
        'date_end',
        'date_start',
    ];
}
