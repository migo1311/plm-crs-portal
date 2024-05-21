<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class College extends Model
{
    use HasFactory;

    protected $primaryKey = 'college_id';

    protected $fillable = [
        'college_code',
        'college_name',
    ];

    public function program(): HasMany
    {
        return $this->hasMany(Program::class, 'college_id', 'college_id');
    }

    public function student(): HasMany
    {
        return $this->hasMany(Student::class, 'college_id', 'college_id');
    }

    public function instructor(): HasMany
    {
        return $this->hasMany(InstructorProfile::class, 'college_id', 'college_id');
    }

    public function studentTerm(): HasMany
    {
        return $this->hasMany(StudentTerm::class, 'college_id', 'college_id');
    }
}
