<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'lastname',
        'firstname',
        'middlename',
        'middleinitial',
        'nameextension',
        'college_id',
        'program_id',
        'yearlevel',
        'plm_email_address',
        'aysem_id',
        'registration_status',
        'block_id',
        'graduating',
        'student_type',
        'birth_date',
        'birth_place',
        'age',
        'gender',
        'civil_status',
        'mobile_num',
        'email_add',
        'religion',
        'height',
        'weight',
        'complexion',
        'blood_type',
        'telephone_num',
        'dominant_hand',
        'medical_history',
        'annual_income',
        'q1_answer',
        'q2_answer',
        'q2a_answer',
        'q2b_answer',
        'q3_answer',
    ];
}
