<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    use HasFactory;

    protected $primaryKey = 'academic_year_id';

    protected $fillable = [
        'academic_year_code',
        'date_end',
        'date_start',
    ];

    public function aysem()
    {
        return $this->hasMany(Aysem::class, 'academic_year_id', 'academic_year_id');
    }

}
