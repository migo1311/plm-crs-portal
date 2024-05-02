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

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class, 'academic_year_id', 'academic_year_id');
    }

    public function blocks()
    {
        return $this->hasMany(Block::class, 'aysem_id', 'aysem_id');
    }
}
