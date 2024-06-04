<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    use HasFactory;

    protected $fillable = [
        'academic_year_code',
        'date_start',
        'date_end',
    ];

    // public function aysems()
    // {
    //     return $this->hasMany(Aysem::class);
    // }
}
