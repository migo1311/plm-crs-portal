<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citizenship extends Model
{
    use HasFactory;

    protected $fillable = [
        'citizenship'
    ];

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function instructors()
    {
        return $this->hasMany(Instructor::class);
    }
}
