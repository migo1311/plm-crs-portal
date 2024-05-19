<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentAddress extends Model
{
    use HasFactory;

    protected $primaryKey = 'student_address_id';

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

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }
}
