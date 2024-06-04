<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentTerm extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_no',
        'aysem_id',
        'program_id',
        'block_id',
        'registration_status_id',
        'student_type',
        'graduating',
        'enrolled',
        'year_level',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_no');
    }

    public function aysem()
    {
        return $this->belongsTo(Aysem::class, 'aysem_id');
    }

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }

    public function block()
    {
        return $this->belongsTo(Block::class, 'block_id');
    }

    public function registrationStatus()
    {
        return $this->belongsTo(RegistrationStatus::class, 'registration_status_id');
    }
}
