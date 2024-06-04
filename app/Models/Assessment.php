<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_no',
        'assess_amount',
        'amount_paid',
        'subsidy',
        'tuition_fee',
        'library_fee',
        'athletic_fee',
        'registration_fee',
        'medical_dental_fee',
        'student_welfare',
        'cultural_activity',
        'guidance_fee',
        'laboratory_fee',
        'development_fund',
        'ang_pamantasan_fee',
        'ssc_fee',
        'fee_status_id',
        'total_assess_fee',
        'previous_payment',
        'units',
        'aysem_id',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_no');
    }

    public function aysem()
    {
        return $this->belongsTo(Aysem::class, 'aysem_id');
    }

    public function refundForm()
    {
        return $this->hasOne(RefundForm::class, 'assessment_id');
    }

    public function feeStatus()
    {
        return $this->belongsTo(FeeStatus::class, 'fee_status_id');
    }
    
}
