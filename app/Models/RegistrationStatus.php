<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_status'
    ];

    public function studentTerms()
    {
        return $this->hasMany(StudentTerm::class);
    }
}
