<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $primaryKey = 'student_no';

    protected $fillable = [
        'biological_sex_id',
        'civil_status_id',
        'citizenship_id',
        'city_id',
        'birthplace_city_id',
        'aysem_id',
        'last_name',
        'first_name',
        'middle_name',
        'maiden_name',
        'suffix',
        'birthdate',
        'permanent_address',
        'pedigree',
        'religion',
        'personal_email',
        'mobile_no',
        'telephone_no',
        'photo_link',
        'entry_date',
        'plm_email',
        'paying',
        'password',
        'graduation_date',
        'height',
        'weight',
        'complexion',
        'blood_type',
        'dominant_hand',
        'medical_history',
        'lrn',
        'school_name',
        'school_address',
        'school_type',
        'strand',
        'year_entered',
        'year_graduated',
        'honors_awards',
        'general_average',
        'remarks',
        'org_name',
        'org_position',
        'previous_tertiary',
        'previous_sem',
        'father_last_name',
        'father_first_name',
        'father_middle_name',
        'father_address',
        'father_contact_no',
        'father_office_employer',
        'father_office_address',
        'father_office_num',
        'mother_last_name',
        'mother_first_name',
        'mother_middle_name',
        'mother_address',
        'mother_contact_no',
        'mother_office_employer',
        'mother_office_address',
        'mother_office_num',
        'guardian_last_name',
        'guardian_first_name',
        'guardian_middle_name',
        'guardian_address',
        'guardian_contact_no',
        'guardian_office_employer',
        'guardian_office_address',
        'guardian_office_num',
        'annual_family_income',
    ];

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

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function birthplaceCity()
    {
        return $this->belongsTo(City::class, 'birthplace_city_id', 'city_id');
    }

    public function aysem()
    {
        return $this->belongsTo(Aysem::class);
    }

    public function studentViolations()
    {
        return $this->hasMany(StudentViolation::class, 'student_no', 'student_no');
    }

    public function classes()
    {
        return $this->belongsToMany(Classes::class, 'student_class', 'student_no', 'class_id')->withTimestamps();
    }

    public function grades()
    {
        return $this->hasMany(Grade::class, 'student_no', 'student_no');
    }

    public function gwas()
    {
        return $this->hasMany(Gwa::class, 'student_no', 'student_no');
    }

    public function assessments()
    {
        return $this->hasMany(Assessment::class, 'student_no', 'student_no');
    }

    public function studentTerms()
    {
        return $this->hasMany(StudentTerm::class, 'student_no', 'student_no');
    }
    
}
