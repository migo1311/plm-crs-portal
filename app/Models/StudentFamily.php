<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentFamily extends Model
{
    use HasFactory;

    protected $primaryKey = 'student_family_id';

    protected   $fillable = [
        'student_id',
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
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }
}
