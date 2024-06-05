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
        'id',
        'last_name',
        'first_name',
        'middle_name',
        'maiden_name',
        'instructor_code',
        'pedigree',
        'birth_date',
        'citizenship',
        'mobile_phone',
        'email_address',
        'tin_number',
        'gsis_number',
        'street_address',
        'zip_code',
        'phone_number',
        'faculty_name',
        'birthplace_id',
        'city_id',
        'biological_sex_id',
        'civil_status_id',
        'college_id',
    ];


}
