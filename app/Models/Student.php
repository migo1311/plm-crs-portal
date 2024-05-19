<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;

    protected $primaryKey = 'student_id';

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

    public function gwa(): HasMany
    {
        return $this->hasMany(Gwa::class, 'student_id', 'student_id');
    }

    public function aysem(): BelongsTo
    {
        return $this->belongsTo(Aysem::class, 'aysem_id', 'aysem_id');
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class, 'program_id', 'program_id');
    }

    public function block(): BelongsTo
    {
        return $this->belongsTo(Block::class, 'block_id', 'block_id');
    }

    public function college(): BelongsTo
    {
        return $this->belongsTo(College::class, 'college_id', 'college_id');
    }

    public function grade(): HasMany
    {
        return $this->hasMany(Grade::class, 'student_id', 'student_id');
    }

    public function assessment(): HasMany
    {
        return $this->hasMany(Assessment::class, 'student_id', 'student_id');
    }

    public function studentAddress(): HasMany
    {
        return $this->hasMany(StudentAddress::class, 'student_id', 'student_id');
    }

    public function studentFamily(): HasMany
    {
        return $this->hasMany(StudentFamily::class, 'student_id', 'student_id');
    }

    public function studentEducation(): HasMany
    {
        return $this->hasMany(StudentEducation::class, 'student_id', 'student_id');
    }

    public function classes(): BelongsToMany
    {
        return $this->belongsToMany(TaClass::class, 'class_student', 'student_id', 'class_id')->withTimestamps();
    }
}
