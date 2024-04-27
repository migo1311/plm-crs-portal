<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstructorProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
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
    
}
