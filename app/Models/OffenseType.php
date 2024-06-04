<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OffenseType extends Model
{
    use HasFactory;

    protected $fillable = [
        'type'
    ];

    public function studentViolations()
    {
        return $this->hasMany(StudentViolation::class);
    }
}
