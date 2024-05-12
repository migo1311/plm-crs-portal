<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InstructorProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'last_name',
        'first_name',
        'middle_name',
        'pedigree',
        'maiden_name',
        'birth_place',
        'birth_date',
        'gender',
        'civil_status',
        'citizenship',
        'mobile_phone',
        'email_address',
        'tin_number',
        'gsis_number',
        'instructor_code',
        'street_address',
        'province_city',
        'zip_code',
        'phone_number',
        'faculty_name',
        'college_id',
    ];

    public function college(): BelongsTo
    {
        return $this->belongsTo(College::class, 'college_id', 'college_id');
    }

    public function classes(): HasMany
    {
        return $this->hasMany(TaClass::class, 'instructor_id', 'instructor_id');
    }

    public function taSummary(): HasMany
    {
        return $this->hasMany(TaSummary::class, 'instructor_id', 'instructor_id');
    }

    public function taConsultation(): HasMany
    {
        return $this->hasMany(TaConsultation::class, 'instructor_id', 'instructor_id');
    }

    public function facultyDesignation(): HasMany
    {
        return $this->hasMany(FacultyDesignation::class, 'instructor_id', 'instructor_id');
    }
    
}
