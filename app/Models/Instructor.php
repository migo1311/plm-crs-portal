<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    use HasFactory;

    protected $fillable = [
        'last_name',
        'first_name',
        'middle_name',
        'maiden_name',
        'instructor_code',
        'pedigree',
        'birth_date',
        'birthplace_id',
        'city_id',
        'biological_sex_id',
        'civil_status_id',
        'citizenship_id',
        'college_id',
        'mobile_phone',
        'email_address',
        'tin_number',
        'gsis_number',
        'street_address',
        'zip_code',
        'phone_number',
        'faculty_name',
    ];

    public function birthplace()
    {
        return $this->belongsTo(City::class, 'birthplace_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function biologicalSex()
    {
        return $this->belongsTo(BiologicalSex::class);
    }

    public function civilStatus()
    {
        return $this->belongsTo(CivilStatus::class);
    }

    public function citizenship()
    {
        return $this->belongsTo(Citizenship::class);
    }

    public function college()
    {
        return $this->belongsTo(College::class);
    }

    public function facultyDesignations()
    {
        return $this->hasMany(FacultyDesignation::class);
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
        return $this->belongsToMany(Classes::class, 'class_faculty', 'instructor_id', 'class_id')->withTimestamps();
    }
}
