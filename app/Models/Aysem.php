<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aysem extends Model
{
    use HasFactory;

    protected $fillable = [
        'academic_year',
        'academic_year_code',
        'semester',
        'academic_year_sem',
        'date_start',
        'date_end',
    ];

    public function blocks()
    {
        return $this->hasMany(Block::class);
    }

    public function taSummary()
    {
        return $this->hasMany(TaSummary::class);
    }

    public function taConsultations()
    {
        return $this->hasMany(TaConsultation::class);
    }

    public function studyLoads()
    {
        return $this->hasMany(StudyLoad::class);
    }

    public function classes()
    {
        return $this->hasMany(Classes::class);
    }

    public function gwas()
    {
        return $this->hasMany(Gwa::class);
    }

    public function assessments()
    {
        return $this->hasMany(Assessment::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function studentTerms()
    {
        return $this->hasMany(StudentTerm::class);
    }
}
