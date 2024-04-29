<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAddress extends Model
{
    use HasFactory;

    protected   $fillable = [
        'student_id',
        'home_street',
        'home_brgy',
        'home_sub_municipality',
        'home_city_municipality',
        'home_province',
        'home_zipcode',
        'home_contact_no',
        'permanent_street',
        'permanent_brgy',
        'permanent_sub_municipality',
        'permanent_city_municipality',
        'permanent_province',
        'permanent_zipcode',
        'permanent_contact_no',
    ];
}
